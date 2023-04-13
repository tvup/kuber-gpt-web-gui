<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServerAssetRequest;
use App\Http\Requests\UpdateServerAssetsRequest;
use App\Models\ServerAsset;
use Illuminate\Support\Arr;

class ServerAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.server_assets.index', ['serverAssets' => ServerAsset::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.server_assets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServerAssetRequest $request)
    {
        $validated = $request->validated();

        return ServerAsset::create(
            [
                'nice_name' => Arr::get($validated, 'nice_name'),
                'local_ip' => Arr::get($validated, 'local_ip'),
                'public_ip' => Arr::get($validated, 'public_ip'),
                'applications' => Arr::get($validated, 'applications'),
                'tags' => Arr::get($validated, 'tags'),
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ServerAsset $serverAsset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServerAsset $serverAsset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServerAssetsRequest $request, ServerAsset $serverAssets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServerAsset $serverAssets)
    {
        //
    }
}
