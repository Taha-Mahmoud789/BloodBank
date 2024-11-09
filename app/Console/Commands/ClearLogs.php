<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLogs extends Command
{
    protected $signature = 'logs:clear';
    protected $description = 'Clear log files';


    public function handle()
    {
        $files = File::files(storage_path('logs'));

        foreach ($files as $file) {
            File::delete($file);
        }

        $this->info('Log files cleared successfully.');
    }
}
