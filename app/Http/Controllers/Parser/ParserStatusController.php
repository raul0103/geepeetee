<?php

namespace App\Http\Controllers\Parser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParserStatusController extends Controller
{
    public function index(Request $request)
    {
        $status_data = Auth::user()->parserStatus($request)->get();

        return view('pages.parser.status', ['status_data' => $status_data]);
    }

    public function deleteAll()
    {
        Auth::user()->parserStatus()->delete();
        return true;
    }
}
