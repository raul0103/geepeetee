<?php

namespace App\Http\Controllers\Parser;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParserStatusController extends Controller
{
    public function index()
    {
        $status_data = Auth::user()->getParserStatusDescId;
        return view('pages.parser.status', ['status_data' => $status_data]);
    }

    public function deleteAll()
    {
        Auth::user()->getParserStatusDescId()->delete();
        return true;
    }
}
