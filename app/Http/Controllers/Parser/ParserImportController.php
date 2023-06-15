<?php

namespace App\Http\Controllers\Parser;

use App\Http\Controllers\Controller;
use App\Http\Requests\GptParserRequest;
use App\Imports\GptParserImport;
use App\Models\Import;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ParserImportController extends Controller
{
    public function index()
    {
        return $this->checkActiveApiKeyByUser(function () {
            return view('pages.parser.import', ['imports' => Import::byUser()]);
        });
    }

    public function import(GptParserRequest $request)
    {
        $new_import = Import::create([
            'name' => $request->import_name,
            'user_id' => Auth::user()->id
        ]);

        return $this->checkActiveApiKeyByUser(function ($active_gpt_key) use ($request, $new_import) {
            Excel::import(new GptParserImport($active_gpt_key, $new_import->id), $request->file);
            return view('pages.parser.import', ['message' => 'Парсер запущен', 'imports' => Import::byUser()]);
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
