<?php

namespace App\Imports;

use App\Jobs\GptParser;
use App\Models\GptParserStatusByUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class GptParserImport implements ToCollection
{
    public $user_active_api_key;

    public function __construct($user_active_api_key)
    {
        $this->user_active_api_key = $user_active_api_key;
    }

    public function collection(Collection $rows)
    {
        $user_id = Auth::user()->id;

        foreach ($rows as $row) {
            $request = $row[0];

            /** 
             * Таким образом пользователь может отследить сколько и какие задачи не обработаны
             * Переданный $status->id позволит удалить статус после завершения задачи
             */
            $status = GptParserStatusByUser::create([
                'request' => $request,
                'status' => 'await',
                'user_id' => $user_id
            ]);

            GptParser::dispatch([
                'user_id' => $user_id,
                'active_api_key' => $this->user_active_api_key
            ], $request, $status->id);
        }
    }
}
