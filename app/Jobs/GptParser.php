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
    public $gbp_parser_status_by_user;

    public function __construct($user, $request, $status_id)
    {
        $this->user = $user;
        $this->request = $request;
        $this->gbp_parser_status_by_user = GptParserStatusByUser::find($status_id);
    }

    public function handle(): void
    {
        try {
            $this->gbp_parser_status_by_user->updateStatus('working');

            /** Отправили запрос */
            $response = Http::timeout(0)->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->user['active_api_key']
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' =>  [["role" => "user", "content" => $this->request]],
                'temperature' =>  0.7,
            ]);

            /** Записали полученные данные */
            GptParserResult::create([
                'request' => $this->request,
                'response' => $response['choices'][0]['message']['content'],
                'user_id' => $this->user['user_id']
            ]);

            $this->gbp_parser_status_by_user->updateStatus('success');
        } catch (Throwable $e) {
            $this->gbp_parser_status_by_user->updateStatus('error');
            throw $e;
        }
    }
}
