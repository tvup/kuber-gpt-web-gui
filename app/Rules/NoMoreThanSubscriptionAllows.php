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
        $user = Auth::user();
        if(!$user) {
            $fail('System error');
        }
        $numberOfAllowedInstances = $this->getAllowedNumberOfRunningInstancesOfUser($user);
        $numberOfAllowedRunningInstances = $this->getNumberOfRunningInstancesOfUser($user);


        if($numberOfAllowedRunningInstances+1 > $numberOfAllowedInstances) {
            $fail('You have exceeded the number of run sets allowed by your subscription.');
        }
    }

    private function getAllowedNumberOfRunningInstancesOfUser(\App\Models\User|\Illuminate\Contracts\Auth\Authenticatable $user) : int
    {
        $allowedQuantityPerProduct = [
            config('products.bronze.id')=> 1,
            config('products.silver.id') => 2,
            config('products.gold.id') => 3
        ];

        if($user->onTrial()) {
            return 1;
        }

        $subscriptions = $user->subscriptions;
        if(!$subscriptions || $subscriptions->count() === 0) {
            return 0;
        }

        $sumOfAllowedRunningInstances = 0;

        $activeSubscriptions = $subscriptions->active() ;
        foreach ($activeSubscriptions as $activeSubscription) {
            $subscriptionItems = $activeSubscription->items;
            foreach ($subscriptionItems as $subscriptionItem) {
                $sumOfAllowedRunningInstances += $allowedQuantityPerProduct[$subscriptionItem->stripe_product];
            }
        }

        return $sumOfAllowedRunningInstances;
    }

    private function getNumberOfRunningInstancesOfUser(\App\Models\User|\Illuminate\Contracts\Auth\Authenticatable $user)
    {
        return $user->runSets->whereNotNull('public_ip')->count();
    }
}
