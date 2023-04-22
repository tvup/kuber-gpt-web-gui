<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProductDisplayController extends Controller
{
    public function index(): View
    {
        return view('layouts.products');
    }

    public function choose(): View
    {
        return view('sales.appetizer', [
            'title' => 'Template Inheritance',
        ]);
    }
}
