<?php

namespace App\Jobs;

use App\Models\GptParserDefaultSetting;
use App\Models\GptParserResult;
use App\Models\GptParserStatus;
use App\Models\Import;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Throwable;

class GptParser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Параметры парсера
    protected $parser_params = [
        'ATTEMPS_MAX' => 1,  // Максимальное кол-во попыток
        'ATTEMPS_SLEEP_TIME' => 1, // Таймаут между ошибками сек.
    ];
    protected $settings; // Параметры для запроса

    public $request;
    public $status_id;
    public $import_id;
    public $active_api_key;
    public $position;

    public function __construct($request, $status_id, $import_id, $active_api_key, $position)
    {
        $this->request = $request;
        $this->status_id = $status_id;
        $this->import_id = $import_id;
        $this->active_api_key = $active_api_key;
        $this->position = $position;

        $this->getSettings();
    }

    public function handle(): void
    {
        if ($this->checkImport() == false)
            return;

        $gpt_parser_status = GptParserStatus::find($this->status_id);

        $response = $this->getResponse();
        try {
            $gpt_parser_status?->updateStatus('working');

            $response = $this->checkResponse($response);

            /** Записали полученные данные */
            GptParserResult::create([
                'request' => $this->request,
                'response' => $response['choices'][0]['message']['content'],
                'import_id' => $this->import_id,
                'position' => $this->position
            ]);

            $gpt_parser_status?->updateStatus('success');
        } catch (Throwable $e) {
            $gpt_parser_status?->update([
                'status' => 'error',
                'message' => $response
            ]);
            throw $e;
        }
    }

    public function getResponse()
    {
        $response = Http::timeout(0)->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->active_api_key
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' =>  [["role" => "user", "content" => $this->request]],
            'temperature' => (int)$this->settings['temperature'],
            'max_tokens' => (int)$this->settings['max_tokens'],
        ]);

        return $response;
    }

    /** 
     * Проверка на то что ответ полный и закончен полность - если finish_reason == 'stop'
     * Либо делаем перезапрос пока не превысим лимит попыток attempts > 10 или будет finish_reason == 'stop'
     */
    public function checkResponse($response)
    {
        $attempts_count = 1; // Количество  запусков

        if (isset($response['choices'][0]['finish_reason']) && $response['choices'][0]['finish_reason'] == 'stop') {
            $finish_reason = true;
        } else {
            $finish_reason = false;
        }

        while (!$finish_reason) {
            sleep($this->parser_params['ATTEMPS_SLEEP_TIME']);

            $response = $this->getResponse();

            if ($attempts_count > $this->parser_params['ATTEMPS_MAX'] || (isset($response['choices'][0]['finish_reason']) && $response['choices'][0]['finish_reason'] == 'stop')) {
                $finish_reason = true;
            }

            $attempts_count++;
        }
        return $response;
    }

    /**
     * Проверит если импорт был удален а задачи по нему еще выполняются то не выполнять их
     */
    public function checkImport()
    {
        $import = Import::find($this->import_id);
        if ($import)
            return true;
        else
            return false;
    }

    /** 
     * Принимает настройки для запроса.
     * Если у пользователя есть свои тогда применить пользовательские
     */
    protected function getSettings()
    {
        $default_settings = GptParserDefaultSetting::get();
        $user_settings = Auth::user()->userSettings->keyBy('default_setting_id');

        foreach ($default_settings as $default_setting) {
            /**
             * Если у пользователя есть данная настройка применить ее значение
             * иначе оставить по умолчанию
             */
            if (isset($user_settings[$default_setting->id])) {
                $this->settings[$default_setting->key] = $user_settings[$default_setting->id]->value;
            } else {
                $this->settings[$default_setting->key] = $default_setting->default;
            }
        }
    }
}
