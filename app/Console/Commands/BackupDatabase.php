<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the MySQL database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fileName = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
        $command = 'mysqldump -u'.env('DB_USERNAME').' -p'.env('DB_PASSWORD').' '.env('DB_DATABASE').' > ' . storage_path('app/backups/') . $fileName . ' 2>&1';
        exec($command, $output, $exitCode);
        if ($exitCode !== 0) {
            $this->error('Error occurred: ' . implode("\n", $output));
        } else {
            $this->info('Database backup saved to: ' . storage_path('app/backups/') . $fileName);
        }
        
    }
}
