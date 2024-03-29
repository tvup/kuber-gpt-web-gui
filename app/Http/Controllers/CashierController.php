<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class CashierController extends Controller
{
    public function checkoutSubscription(Request $request)
    {
        return auth()->user()
            ->newSubscription('default', 'price_1MzbKvJsg0XlNoyeiQtA7fmA')
            ->checkout();
    }
}
