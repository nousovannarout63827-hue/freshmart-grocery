<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ListUsers extends Command
{
    protected $signature = 'users:list';
    protected $description = 'List all users in the database';

    public function handle()
    {
        $users = User::all(['name', 'email', 'role']);
        
        $this->table(
            ['Name', 'Email', 'Role'],
            $users->map(fn($u) => [$u->name, $u->email, $u->role])->toArray()
        );
        
        return Command::SUCCESS;
    }
}
