<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestControler extends Controller
{
    function index() {
        $view_data = [
            'posts' => "Ini post",
            'comments' => ["Satu", "Dua", "Tiga"],
            'replys' => [
                ["title", "content"],
                ["title2", "content2"],
            ]
        ];

        return view('test', $view_data);
    }
}
