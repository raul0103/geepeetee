<?php

namespace App\Exports;

use App\Models\Import;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GptParserResultsExport implements FromCollection, WithHeadings
{
    public $import_id;

    public function __construct($import_id)
    {
        $this->import_id = $import_id;
    }

    public function collection()
    {
        return Import::find($this->import_id)->results()->select(['request', 'response'])->get();
    }

    public function headings(): array
    {
        return ["Запрос", "Ответ"];
    }
}
