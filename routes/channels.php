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
    logger()->info('Auth channel: ' . $user->id . ' ' . $id);
    logger()->info('Authenticated? ' . ((int) $user->id === (int) $id) ? 'true' : 'false');
    return (int) $user->id === (int) $id;
});
