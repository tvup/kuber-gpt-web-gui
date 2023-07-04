<?php

namespace App\Http\Controllers\API;

use App\Events\IpFromConductorEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicIPForRunSetRequest;
use App\Models\RunSet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RunSetController extends Controller
{
    public function ip(Request $request, RunSet $run_set) {
        $ip = $request->input('ip');

        $run_set->public_ip = $ip;
        $run_set->save();

        $array = ['user_id'=>$run_set->user->id, 'ip' => $ip, 'run_set_id' => $run_set->id]; //data we want to pass
        IpFromConductorEvent::dispatch($array);

        return new JsonResponse($run_set);
    }
}
