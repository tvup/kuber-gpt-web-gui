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
    public function launch() {
        $run_set_id = request()->get('run_set');
        $run_set = RunSet::find($run_set_id);
        //check that the user does not have valid active certificates
        $user = auth()->user();
//        if($user->allowed_a_is <= $user->a_is_running) {
//            return redirect()->back()->with('msg-danger', 'Error: Valid certificate(s) already exist');
//        }

        $array = $run_set->toArray();
        $array['user_id'] = auth()->user()->id;

        //I proceed if it has no active valid certificates
        Redis::publish(config('database.redis.default.create_channel'), json_encode($array));

        return redirect()->back()->with('msg-success', 'AI created!');
    }
}
