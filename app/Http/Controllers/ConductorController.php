<?php

namespace App\Http\Controllers;

use App\Models\RunSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use RedisException;

class ConductorController extends Controller
{
    /**
     * @throws RedisException
     */
    public function launch(RunSet $run_set) {
        //check that the user does not have valid active certificates
        $user = auth()->user();
        if($user->allowed_a_is <= $user->a_is_running) {
            return redirect()->back()->with('msg-danger', 'Error: Valid certificate(s) already exist');
        }

        //I proceed if it has no active valid certificates
        Redis::publish(config('database.redis.default.create_channel'), $run_set);

        return redirect()->back()->with('msg-success', 'AI created!');
    }
}
