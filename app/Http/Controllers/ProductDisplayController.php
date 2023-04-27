<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\View\View;

class ProductDisplayController extends Controller
{
    public function index(): View
    {
        return view('products.appetizer', [
            'title' => 'Template Inheritance',
            'products' => Price::whereEnvironment(config('app.simulate'))->get()
        ]);
    }

    public function choose(): View
    {
        return view('sales.appetizer', [
            'title' => 'Template Inheritance',
        ]);
    }
}
