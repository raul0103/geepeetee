<?php

namespace App\Http\Controllers\Parser;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParserResultController extends Controller
{
    public function index()
    {
        $results = Auth::user()->getParserResultDescId;
        return view('pages.parser.results', ['results' => $results]);
    }
}
