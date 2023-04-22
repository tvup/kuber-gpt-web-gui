<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProductDisplayController extends Controller
{
    public function index(): View
    {
        return view('products.appetizer', [
            'title' => 'Template Inheritance',
        ]);
    }

    public function choose(): View
    {
        return view('sales.appetizer', [
            'title' => 'Template Inheritance',
        ]);
    }
}
