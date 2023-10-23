<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateStorageLink extends Command
{
    protected $signature = 'custom:storagelink';
    protected $description = 'Create the symbolic link to the storage directory';

    public function handle()
    {
        $this->info('Creating storage symbolic link...');
        app('files')->link(storage_path('app/public'), public_path('storage'));
        $this->info('Storage symbolic link created.');
    }
}
