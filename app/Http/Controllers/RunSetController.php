<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicIPForRunSetRequest;
use App\Http\Requests\StoreRunSetRequest;
use App\Http\Requests\UpdateRunSetRequest;
use App\Models\CredentialsSet;
use App\Models\RunSet;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RunSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $runSets = auth()->user()->runSets;

        return view('run_sets.index', ['run_sets' => $runSets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $credentialsSets = auth()->user()->credentialsSets;

        return view('run_sets.create', ['credentials_sets' => $credentialsSets]);
    }

    /**
     * Display the specified resource.
     */
    public function show(RunSet $runSet): View
    {
        return view('run_sets.show', ['run_set' => $runSet]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RunSet $runSet): View
    {
        $credentialsSets = auth()->user()->credentialsSets;

        return view('run_sets.edit', ['run_set' => $runSet, 'credentials_sets' => $credentialsSets]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRunSetRequest $request): RedirectResponse
    {
        $validated = $request->validate($request->rules());

        $runSet = app(RunSet::class);
        $runSet->nick_name = Arr::get($validated, 'nick_name');
        $runSet->created_at = Arr::get($validated, 'created_at');
        $runSet->public_ip = Arr::get($validated, 'public_ip');
        $runSet->tags = Arr::get($validated, 'tags');
        /** @var User $user */
        $user = auth()->user();
        $runSet->user()->associate($user);

        $credentialsSetId = Arr::get($validated, 'credentials_set');
        if ($credentialsSetId) {
            $credentialsSet = CredentialsSet::whereId($credentialsSetId)->first();
            if ($credentialsSet) {
                $runSet->credentialsSet()->associate($credentialsSet);
            }
        }

        $runSet->save();

        return redirect('/run_sets')->with(['msg-success' => 'Run set stored']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRunSetRequest $request, RunSet $runSet): RedirectResponse
    {
        $validated = $request->validated();

        $runSet->nick_name = Arr::get($validated, 'nick_name');
        $runSet->created_at = Arr::get($validated, 'created_at');
        $runSet->public_ip = Arr::get($validated, 'public_ip');
        $runSet->local_ip = Arr::get($validated, 'local_ip');
        $runSet->tags = Arr::get($validated, 'tags');

        $credentialsSetId = Arr::get($validated, 'credentials_set');
        if ($credentialsSetId) {
            $credentialsSet = CredentialsSet::whereId($credentialsSetId)->first();
            if ($credentialsSet) {
                $runSet->credentialsSet()->associate($credentialsSet);
            }
        } else {
            $credentialsSet = $runSet->credentialsSet;
            if ($credentialsSet) {
                $runSet->credentialsSet()->dissociate();
            }
        }

        $runSet->save();

        return redirect('/run_sets')->with(['msg-success' => 'Run set updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RunSet $runSet): RedirectResponse
    {
        $array = [];
        $array['nickname'] = Str::lower($runSet->nick_name);

        Redis::publish(config('database.redis.default.revoke_channel'), json_encode($array));

        $runSet->delete();

        return redirect('/run_sets')->with(['msg-danger' => 'Run set deleted']);
    }

    public function ip(StorePublicIPForRunSetRequest $request, RunSet $run_set)
    {
        $ip = $request->get('ip');

        $run_set->public_ip = $ip;
        $run_set->save();

        return new JsonResponse($run_set);
    }
}
