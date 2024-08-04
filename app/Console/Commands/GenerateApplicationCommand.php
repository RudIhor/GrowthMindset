<?php

namespace App\Console\Commands;

use App\Models\Application;
use Illuminate\Console\Command;

class GenerateApplicationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:application';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates an application';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->ask('What is the name of application?', uniqid());
        $token = bin2hex(openssl_random_pseudo_bytes(20));

        $application = new Application();
        $application->name = $name;
        $application->token = $token;
        $application->save();

        $this->info('[INFO] Application was created successfully! Application\'s credentials:');
        $this->info(sprintf("Name:\n%s\nToken: \n%s", $name, $token));
    }
}
