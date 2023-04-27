<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRunSetRequest;
use App\Http\Requests\UpdateRunSetRequest;
use App\Models\RunSet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class RunSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('run_sets.index', ['run_sets' => RunSet::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('run_sets.create');
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
        return view('run_sets.edit', ['serverAsset' => $runSet]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRunSetRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $runSet = app(RunSet::class);
        $runSet->nick_name = Arr::get($validated, 'nick_name');
        $runSet->created_at = Arr::get($validated, 'created_at');
        $runSet->public_ip = Arr::get($validated, 'public_ip');
        $runSet->tags = Arr::get($validated, 'tags');
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
        $runSet->tags = Arr::get($validated, 'tags');
        $runSet->save();

        return redirect('/run_sets')->with(['msg-success' => 'Run set updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RunSet $runSet): RedirectResponse
    {
        $runSet->delete();

        return redirect('/run_sets')->with(['msg-danger' => 'Run set deleted']);
    }
}