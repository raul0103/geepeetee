<?php

namespace App\Http\Controllers\Parser;

use App\Exports\GptParserResultsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use App\Models\Import;
use Maatwebsite\Excel\Facades\Excel;

class ParserResultController extends Controller
{
    public function index(ResultRequest $request)
    {
        $results = Import::findOrFail($request->import_id)->results()->orderBy('position', 'asc')->get();
        return view('pages.parser.results', ['results' => $results]);
    }


    public function downloadExcel(ResultRequest $request)
    {
        return Excel::download(new GptParserResultsExport($request->import_id), 'results.xlsx');
    }
}
