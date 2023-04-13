<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServerAssetRequest;
use App\Http\Requests\UpdateServerAssetsRequest;
use App\Models\ServerAsset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class ServerAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.server_assets.index', ['serverAssets' => ServerAsset::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.server_assets.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServerAsset $server_asset): View
    {
        return view('admin.server_assets.show', ['serverAsset' => $server_asset]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServerAsset $server_asset): View
    {
        return view('admin.server_assets.edit', ['serverAsset' => $server_asset]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServerAssetRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $server_asset = app(ServerAsset::class);
        $server_asset->nick_name = Arr::get($validated, 'nick_name');
        $server_asset->local_ip = Arr::get($validated, 'local_ip');
        $server_asset->public_ip = Arr::get($validated, 'public_ip');
        $server_asset->applications = Arr::get($validated, 'applications');
        $server_asset->tags = Arr::get($validated, 'tags');
        $server_asset->save();

        return redirect('/admin/server_assets')->with(['msg-success' => 'Server asset stored']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServerAssetsRequest $request, ServerAsset $server_asset): RedirectResponse
    {
        $validated = $request->validated();

        $server_asset->nick_name = Arr::get($validated, 'nick_name');
        $server_asset->local_ip = Arr::get($validated, 'local_ip');
        $server_asset->public_ip = Arr::get($validated, 'public_ip');
        $server_asset->applications = Arr::get($validated, 'applications');
        $server_asset->tags = Arr::get($validated, 'tags');
        $server_asset->save();

        return redirect('/admin/server_assets')->with(['msg-success' => 'Server asset updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServerAsset $server_asset): RedirectResponse
    {
        $server_asset->delete();

        return redirect('/admin/server_assets')->with(['msg-danger' => 'Server asset deleted']);
    }
}
