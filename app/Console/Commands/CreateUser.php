<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    protected $signature = 'user:create';
    protected $description = 'Create default admin and member users';

    public function handle()
    {
        // Create Admin
        $adminEmail = 'admin@example.com';
        $adminPassword = 'password';

        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => $adminEmail,
                'password' => Hash::make($adminPassword),
                'role' => 'admin',
            ]);
            $this->info("Admin created: {$adminEmail} / {$adminPassword}");
        } else {
            $this->info("Admin already exists: {$adminEmail}");
        }

        // Create Member
        $memberEmail = 'member@example.com';
        $memberPassword = 'password';

        if (!User::where('email', $memberEmail)->exists()) {
            User::create([
                'name' => 'Member User',
                'email' => $memberEmail,
                'password' => Hash::make($memberPassword),
                'role' => 'member',
            ]);
            $this->info("Member created: {$memberEmail} / {$memberPassword}");
        } else {
            $this->info("Member already exists: {$memberEmail}");
        }

        $this->info('Default users setup complete!');
    }
}
