<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicIPForRunSetRequest;
use App\Http\Requests\StoreRunSetRequest;
use App\Http\Requests\UpdateRunSetRequest;
use App\Models\CredentialsSet;
use App\Models\RunSet;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RunSetController extends Controller
{
    public function ip(StorePublicIPForRunSetRequest $request, RunSet $run_set) {
        $ip = $request->get('ip');

        $run_set->public_ip = $ip;
        $run_set->save();

        return new JsonResponse($run_set);
    }
}
