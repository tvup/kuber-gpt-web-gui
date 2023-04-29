<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKeySetRequest;
use App\Models\Credential;
use App\Models\CredentialsSet;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class CredentialsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        /** @var CredentialsSet $credentialsSet */
        $credentialsSet = CredentialsSet::whereUserId(auth()->user()->id)->orderBy('created_at','desc')->firstOrCreate();
        $credentials = $credentialsSet->credentials;

        return view('credentials.index', ['credentials' => $credentials]);
    }

    public function store(StoreKeySetRequest $request)
    {
        $validated = $request->validated();
        /** @var User $user */
        $user = auth()->user();
        $credentialsSet = $user->credentialsSet()->firstOrCreate();
        $credentialsSet->credentials()->create(['name' => Arr::get($validated, 'name'), 'key' => Arr::get($validated, 'key'), 'value' => Arr::get($validated, 'value')]);
        return new JsonResponse($credentialsSet->toJson());
    }

}
