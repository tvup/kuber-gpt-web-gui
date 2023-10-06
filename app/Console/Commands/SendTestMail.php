<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mailgun\HttpClient\HttpClientConfigurator;
use Mailgun\Hydrator\NoopHydrator;
use Mailgun\Mailgun;

class SendTestMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-test';

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
        $configurator = new HttpClientConfigurator();
        $configurator->setEndpoint(config('services.mailgun.endpoint'));
        $configurator->setApiKey(config('services.mailgun.secret'));
        $configurator->setDebug(false);

        $mgClient = new Mailgun($configurator, new NoopHydrator());
        $domain = config('services.mailgun.domain');
        // Make the call to the client.
        $return = $mgClient->messages()->send($domain, [
            'from'	=> 'Excited User <mailgun@' . $domain . '>',
            'to'	=> 'Torben Evald Hansen <test-945wx4dbx@srv1.mail-tester.com>',
            'subject' => 'Hello',
            'text'	=> 'Testing some Mailgun awesomeness!',
        ]);
    }
}
