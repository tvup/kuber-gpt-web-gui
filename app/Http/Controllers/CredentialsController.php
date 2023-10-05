<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyKeySetRequest;
use App\Http\Requests\StoreKeySetRequest;
use App\Http\Requests\UpdateKeySetRequest;
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
        $credentialsSet = CredentialsSet::whereUserId(auth()->user()->id)->orderBy('created_at', 'desc')->firstOrCreate();
        $credentials = $credentialsSet->credentials;

        return view('credentials.index', ['credentials' => $credentials]);
    }

    public function store(StoreKeySetRequest $request)
    {
        $validated = $request->validated();
        /** @var User $user */
        $user = auth()->user();
        $credentialsSet = $user->credentialsSets()->firstOrCreate();
        $credentialsSet->credentials()->create(['name' => Arr::get($validated, 'name'), 'key' => Arr::get($validated, 'key'), 'value' => Arr::get($validated, 'value')]);

        return new JsonResponse($credentialsSet->toJson());
    }

    public function update(UpdateKeySetRequest $request)
    {
        $validated = $request->validated();
        /** @var User $user */
        $user = auth()->user();
        $credentialsSet = $user->credentialsSets()->firstOrFail();
        $credential = $credentialsSet->credentials()->where('key', Arr::get($validated, 'key'))->first();
        $credential->name = Arr::get($validated, 'name');
        $credential->value = Arr::get($validated, 'value');
        $result = $credential->save();

        return new JsonResponse($credential->toJson(), $result ? 200 : 422);
    }

    public function destroy(DestroyKeySetRequest $request)
    {
        $validated = $request->validated();
        /** @var User $user */
        $user = auth()->user();
        $credentialsSet = $user->credentialsSet()->firstOrFail();
        $credentialsSet = $credentialsSet->credentials()->where(['key'=>Arr::get($validated, 'key')]);
        $result = $credentialsSet->delete();

        return new JsonResponse($result, $result ? 200 : 422);
    }
}
