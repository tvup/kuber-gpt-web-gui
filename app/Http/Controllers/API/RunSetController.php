<?php

namespace App\Http\Controllers\API;

use App\Events\IpFromConductorEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicIPForRunSetRequest;
use App\Models\RunSet;
use Illuminate\Http\JsonResponse;

class RunSetController extends Controller
{
    public function ip(StorePublicIPForRunSetRequest $request, RunSet $run_set) {
        $ip = $request->get('ip');

        $run_set->public_ip = $ip;
        $run_set->save();

        $array = ['user'=>auth()->user()->id, 'ip' => '1.2.3.4']; //data we want to pass
        event(new \App\Events\IpFromConductorEvent($array));

        return new JsonResponse($run_set);
    }
}
