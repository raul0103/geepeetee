<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QueryListController extends Controller
{
    public function __invoke()
    {
        return view('pages.query-list');
    }
}
