<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateFirstAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CreateFirstAdminUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create First Admin User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        if (is_null(User::where('email', 'admin@admin.admin')->first())) {
            //dd('ok');
            //if (User::where('email', 'admin@admin.admin'))

            //$name = $this->ask('What is the nick name?');
            //$first_name = $this->ask('What is the first name?');
            //$last_name = $this->ask('What is the last name?');
            //$cf = $this->ask('What is the Codice Fiscale?');
            //$email = $this->ask('What is the email address?');
            $password = $this->secret('What is the password?');

            User::create([
                //'name' => $name,
                //'nome' => $first_name,
                //'cognome' => $last_name,
                //'cf' => $cf,
                //'email' => $email,
                'user_name' => 'admin',
                'nome' => 'admin',
                'cognome' => 'admin',
                'cf' => 'admin',
                'email' => 'admin@admin.admin',
                'rule' => 'admin',
                'password' => bcrypt($password),
            ]);

            $this->info('User admin: admin@admin.admin was created - now you can login with email-password');
        } else {
            $this->info('User admin: admin@admin.admin exist. Exit.');
        }

    return 0;
    }
}
