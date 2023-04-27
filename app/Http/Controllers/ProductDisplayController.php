<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\View\View;

class ProductDisplayController extends Controller
{
    public function index(): View
    {
        return view('products.appetizer', [
            'title' => config('app.name', 'Laravel'),
            'products' => Price::whereEnvironment(config('app.simulate'))->get()
        ]);
    }

    public function choose(): View
    {
        return view('landing-pages.appetizer', [
            'title' => config('app.name', 'Laravel'),
        ]);
    }
}
