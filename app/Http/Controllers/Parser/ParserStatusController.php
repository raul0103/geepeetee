<?php

namespace App\Http\Controllers\Parser;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Models\GptParserStatus;
use App\Models\Import;
use Illuminate\Http\Request;

class ParserStatusController extends Controller
{
    public function index(StatusRequest $request)
    {
        // $status_data = Auth::user()->parserStatus($request)->get();
        $statuses = Import::findOrFail($request->import_id)->statuses;
        return view('pages.parser.status', ['statuses' => $statuses]);
    }

    public function deleteAll()
    {
        // Auth::user()->parserStatus()->delete();
        return true;
    }
}
