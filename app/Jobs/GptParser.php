<?php

namespace App\Jobs;

use App\Models\GptParserResult;
use App\Models\GptParserStatus;
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

    public $request;
    public $status_id;
    public $import_id;
    public $active_api_key;

    public function __construct($request, $status_id, $import_id, $active_api_key)
    {
        $this->request = $request;
        $this->status_id = $status_id;
        $this->import_id = $import_id;
        $this->active_api_key = $active_api_key;
    }

    public function handle(): void
    {
        $gbp_parser_status = GptParserStatus::find($this->status_id);

        try {
            $gbp_parser_status?->updateStatus('working');

            $response = $this->getResponse();
            $response = $this->checkResponse($response);

            /** Записали полученные данные */
            GptParserResult::create([
                'request' => $this->request,
                'response' => $response['choices'][0]['message']['content'],
                'import_id' => $this->import_id
            ]);

            $gbp_parser_status?->updateStatus('success');
        } catch (Throwable $e) {
            $gbp_parser_status?->update([
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
            'temperature' =>  0.7,
        ]);

        return $response;
    }

    /** 
     * Проверям если в ответе нет поля choices - перезапускаем пока это поле не появится. Либо пока не превысим лимит попыток attempts > 10
     */
    public function checkResponse($response)
    {
        $attempts = 1; // Количество  запусков
        $isset_choices = isset($response['choices']);
        while (!$isset_choices) {
            sleep(20);

            $response = $this->getResponse();
            $isset_choices = isset($response['choices']);

            if ($attempts > 10) {
                $isset_choices = true;
            }
            $attempts++;
        }
        return $response;
    }
}
