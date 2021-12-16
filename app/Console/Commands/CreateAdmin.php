<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sds:create-admin
                            {password=2m@rtD0c : The password for the admin account}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin account in the application';

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
     * @return int
     */
    public function handle()
    {
        $user = User::create([
            "firstName" => "Administrator",
            "lastName" => "",
            "username" => "administrator",
            "email" => "administrator@localhost",
            "password" => \Hash::make($this->argument('password')),
            "active" => true
        ]);

        $permissionNames = ["view-any", "view", "create", "update", "delete", "restore", "force-delete"];
        $permissionPrefixes = [
            "client-contact",
            "client",
            "comment",
            "document",
            "file",
            "qr-code",
            "revision",
            "revision-request-category",
            "revision-request-comment",
            "revision-request-document",
            "revision-request",
            "user-permission",
            "user",
        ];

        foreach ($permissionPrefixes as $permissionPrefix) {
            foreach ($permissionNames as $permissionName) {
                $user->permissions()->create([
                    "permissionName" => "{$permissionPrefix}:{$permissionName}"
                ]);
            }
        }

        if ($user) {
            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}
