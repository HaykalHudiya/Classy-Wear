<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function newa()
    {
        return view('components.newa');
    }
    public function best()
    {
        return view('components.best');
    }
    public function outwear()
    {
        return view('components.outwear');
    }
    public function tshirt()
    {
        return view('components.ts');
    }
    public function pants()
    {
        return view('components.pants');
    }
}
