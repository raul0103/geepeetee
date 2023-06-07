<?php

namespace App\Http\Controllers\Parser;

use App\Http\Controllers\Controller;
use App\Http\Requests\GptParserRequest;
use App\Imports\GptParserImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ParserImportController extends Controller
{
    public function index()
    {
        return $this->checkActiveApiKeyByUser(function () {
            return view('pages.parser.import');
        });
    }

    public function import(GptParserRequest $request)
    {
        return $this->checkActiveApiKeyByUser(function ($active_gpt_key) use ($request) {
            Excel::import(new GptParserImport($active_gpt_key), $request->file);
            return view('pages.parser.import', ['message' => 'Парсер запущен']);
        });
    }

    protected function checkActiveApiKeyByUser($callback)
    {
        $active_gpt_key = $this->getActiveApiKeyByUser();

        if ($active_gpt_key) return $callback($active_gpt_key);
        else return view('pages.parser.import', ['access_closed' => true, 'message' => 'У вас нет активного API ключа']);
    }
    protected function getActiveApiKeyByUser()
    {
        return Auth::user()->getActiveGptApiKey()?->key;
    }
}
