<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Predis\Client;

class ConnectToRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:connect-to-redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $config = config()->get('database.redis.default');

        //$config = Arr::except($config, ['transport']);

        $redis = new Client($config);

        $pubsub = $redis->pubSub();
        $pubsub->subscribe('test-channel');

        foreach ($pubsub as $message)
        {
            switch ($message->kind) {
                case 'subscribe':
                    echo "Subscribed to {$message->channel}\n";
                    break;

                case 'message':
                    // do something
                    break;
            }
        }
    }
}
