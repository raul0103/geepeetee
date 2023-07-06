<?php

namespace App\Imports;

use App\Jobs\GptParser;
use App\Models\GptParserStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class GptParserImport implements ToCollection
{
    public $user_active_api_key;
    public $import_id;

    public function __construct($user_active_api_key, $import_id)
    {
        $this->user_active_api_key = $user_active_api_key;
        $this->import_id = $import_id;
    }

    public function collection(Collection $rows)
    {
        $position = 0;
        foreach ($rows as $row) {
            $request = $row[0];

            /** 
             * Таким образом пользователь может отследить сколько и какие задачи не обработаны
             * Переданный $status->id позволит удалить статус после завершения задачи
             */
            $status = GptParserStatus::create([
                'request' => $request,
                'status' => 'await',
                'import_id' =>  $this->import_id
            ]);

            GptParser::dispatch(
                $request,
                $status->id,
                $this->import_id,
                $this->user_active_api_key,
                $position++
            );
        }
    }
}
