<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class NoMoreThanSubscriptionAllows implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        logger()->info('Validating user with id ' . Auth::user()->id . ' actions');
        $subscriptionItem = Auth::user()->subscriptions->first()?->items->first();
        $allowedQuantityPerProduct = ['prod_Nn2LFeAVDg4INl'=> 1, 'prod_Nn2KRZrCEJ37Uu' => 1, 'prod_Nn2JPI08USBQEV' => 2];
        $runningAisOfUser = Auth::user()->runSets->whereNotNull('public_ip')->count();
        logger()->info('Product id: '.$subscriptionItem->product_id);
        if($runningAisOfUser+1 > $allowedQuantityPerProduct[$subscriptionItem->product_id]) {
            $fail('You have exceeded the number of run sets allowed by your subscription.');
        }
    }
}
