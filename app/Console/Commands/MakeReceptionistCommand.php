<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Receptionist;
use Illuminate\Support\Facades\Hash;

class MakeReceptionistCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:receptionist {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new receptionist account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        if (Receptionist::where('email', $email)->exists()) {
            $this->error("Receptionist with email {$email} already exists!");
            return Command::FAILURE;
        }

        Receptionist::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("Receptionist {$name} created successfully!");
        return Command::SUCCESS;
    }
}
