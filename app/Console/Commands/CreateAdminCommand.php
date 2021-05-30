<?php

namespace App\Console\Commands;

use App\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admins:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Cyan admin.';

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
        $this->startCommand();

        Admin::create([
            'full_name' => 'Super admin',
            'email'     => 'admin@cyan.com',
            'password'  => Hash::make('12345678'),
        ]);

        $this->finishCommand();
    }

    private function startCommand(): void
    {
        $this->line("Starting {$this->getName()} command.");
    }

    private function finishCommand(): void
    {
        $this->line("End {$this->getName()} command.");
    }
}
