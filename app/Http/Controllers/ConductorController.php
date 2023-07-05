<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaunchMegaRunSetRequest;
use App\Http\Requests\LaunchRunSetRequest;
use App\Models\Credential;
use App\Models\CredentialsSet;
use App\Models\RunSet;
use Faker\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
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
        $run_set->update(['tags->submitted' => true]);

        //check that the user does not have valid active certificates
        $user = auth()->user();
//        if($user->allowed_a_is <= $user->a_is_running) {
//            return redirect()->back()->with('msg-danger', 'Error: Valid certificate(s) already exist');
//        }

        $credentialsSetId = $run_set->credentialsSet?->id;
        /** @var Collection $credentialsCollection */
        $credentialsCollection = Credential::whereCredentialsSetId($credentialsSetId)->get();
        $credentialsArray = [];
        foreach (CredentialsSet::$keys as $key) {
            $credential = $credentialsCollection->where('key', $key)->first();
            if(!$credential) {
                $credential = new Credential();
                $credential->key = $key;
                $credential->value = CredentialsSet::$defaultValues[$key];
                $credential->credentials_set_id = $credentialsSetId;
                $credential->save();
            } else {
                $credentialsCollection->pull($credential->id);
            }
            $credentialsArray[] = $credential;
        }

        foreach ($credentialsCollection as $credential) {
            $credentialsArray[] = $credential;
        }

        $array = [];
        $array['user_id'] = auth()->user()->id;
        $array['run_set_id'] = $run_set->id;
        $array['nick_name'] = Str::lower($run_set->nick_name);
        $array['run_set'] = $run_set->toArray();
        $array['credentials_set'] = $credentialsArray;

        //I proceed if it has no active valid certificates
        $listeners = Redis::publish(config('database.redis.default.create_channel'), json_encode($array));

        return view('run_sets.index', compact('run_set'))->with('msg-success', 'Run set submitted successfully');
    }    /**
     * @throws RedisException
     */
    public function megaLaunch(LaunchMegaRunSetRequest $request) {
        $validated = $request->validate($request->rules());

        /** @var RunSet $run_set */
        $user = auth()->user();
        $run_set = $user->runSets()->create();
        $run_set->update(['tags->submitted' => true]);
        $faker = Factory::create();
        $run_set->nick_name = Str::lower($faker->firstName());

        /** @var CredentialsSet $credentialsSet */
        $credentialsSet = app(CredentialsSet::class);
        $credentialsSet->save();
        $run_set->credentialsSet()->associate($credentialsSet);
        $run_set->save();


        $credentialsSet->user()->associate($user);
        $credentialsSet->save();


        $credentialsArray = [];

        $credential = new Credential();
        $credential->key = 'OPENAI_API_KEY';
        $credential->value = Arr::get($validated, 'token');
        $credential->credentials_set_id = $credentialsSet->id;
        $credential->save();
        $credentialsArray[] = $credential;
        unset($credential);


        foreach (CredentialsSet::$keys as $key) {
            $credential = new Credential();
            $credential->key = $key;
            $credential->value = CredentialsSet::$defaultValues[$key];
            $credential->credentials_set_id = $credentialsSet->id;
            $credential->save();
            $credentialsArray[] = $credential;
        }

        $array = [];
        $array['user_id'] = $user->id;
        $array['run_set_id'] = $run_set->id;
        $array['nick_name'] = Str::lower($run_set->nick_name);
        $array['run_set'] = $run_set->toArray();
        $array['credentials_set'] = $credentialsArray;

        $run_set->save();

        //I proceed if it has no active valid certificates
        $listeners = Redis::publish(config('database.redis.default.create_channel'), json_encode($array));

        return view('run_sets.index', compact('run_set'))->with('msg-success', 'Run set submitted successfully');
    }

}
