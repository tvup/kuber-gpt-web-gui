<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaunchRunSetRequest;
use App\Models\RunSet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use RedisException;

class ConductorController extends Controller
{
    /**
     * @throws RedisException
     */
    public function launch(LaunchRunSetRequest $request) {
        $request->validate($request->rules());

        $run_set_id = request()->get('run_set');
        /** @var RunSet $run_set */
        $run_set = RunSet::find($run_set_id);
        $this->markAsLaunched($run_set);

        //check that the user does not have valid active certificates
        $user = auth()->user();
//        if($user->allowed_a_is <= $user->a_is_running) {
//            return redirect()->back()->with('msg-danger', 'Error: Valid certificate(s) already exist');
//        }


        $array = [];
        $array['user_id'] = auth()->user()->id;
        $array['run_set_id'] = $run_set->id;
        $array['nick_name'] = Str::lower($run_set->nick_name);
        $array['run_set'] = $run_set->toArray();
        $array['credentials_set'] = $run_set->credentialsSet?->credentials?->toArray();

        //I proceed if it has no active valid certificates
        $listeners = Redis::publish(config('database.redis.default.create_channel'), json_encode($array));

        return new JsonResource(['active_listeners'=>$listeners]);
    }

    /**
     * @param RunSet $run_set
     * @return void
     */
    public function markAsLaunched(RunSet $run_set): void
    {
        $tags = $run_set->tags;
        array_push($tags, 'is-submitted');
        $run_set->update(['tags' => $tags]);
        $run_set->save();
    }
}
