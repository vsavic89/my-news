<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyNewsController extends Controller
{
    public function show()
    {
        return view('my_news.show');
    }
}
