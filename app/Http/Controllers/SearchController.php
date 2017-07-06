<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function enter(Request $request)
    {
        return view('search');
    }

    public function show(Request $request)
    {
        return view('search_result');
    }
}
