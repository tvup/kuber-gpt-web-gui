<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProductDisplayController extends Controller
{
    public function index(): View
    {
        return view('product.appetizer', [
            'title' => 'Template Inheritance',
        ]);
    }

    public function choose(): View
    {
        return view('layouts.products');
    }
}
