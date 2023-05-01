<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use App\Models\User;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('users.{$userId}', function (User $user, int $runSetId) {
    /** @var User $user */
    $user= User::find($user->id);
    $runSetIds = $user->runSets->pluck('id')->toArray();
    return in_array($runSetId, $runSetIds);
});
