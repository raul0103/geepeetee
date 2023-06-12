<?php

namespace App\Jobs;

use App\Models\GptParserResult;
use App\Models\GptParserStatusByUser;
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

    public $user;
    public $request;
    public $status_id;

    public function __construct($user, $request, $status_id)
    {
        $this->user = $user;
        $this->request = $request;
        $this->status_id = $status_id;
    }

    public function handle(): void
    {
        $gbp_parser_status_by_user = GptParserStatusByUser::find($this->status_id);

        try {
            $gbp_parser_status_by_user?->updateStatus('working');

            $response = $this->getResponse();
            $response = $this->checkResponse($response);

            /** Записали полученные данные */
            GptParserResult::create([
                'request' => $this->request,
                'response' => $response['choices'][0]['message']['content'],
                'user_id' => $this->user['user_id']
            ]);

            $gbp_parser_status_by_user?->updateStatus('success');
        } catch (Throwable $e) {
            $gbp_parser_status_by_user?->update([
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
            'Authorization' => 'Bearer ' . $this->user['active_api_key']
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
