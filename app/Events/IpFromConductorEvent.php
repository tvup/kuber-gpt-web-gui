<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IpFromConductorEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public int $user_id;
    public string $ip;
    public int $run_set_id;

    public function __construct(array $message)
    {
        $this->user_id = $message['user_id'];
        $this->ip = $message['ip'];
        $this->run_set_id = $message['run_set_id'];
        logger()->info('Broadcasting event to user: ' . $this->user_id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('App.User.'.$this->user_id),
        ];
    }

    public function broadcastAs()
    {
        return 'ip-from-conductor-event';
    }
}

