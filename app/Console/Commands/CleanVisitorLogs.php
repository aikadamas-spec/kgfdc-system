<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CleanVisitorLogs extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'visitors:clean
                            {--days=180 : Delete logs older than this many days (default: 180)}';

    /**
     * The console command description.
     */
    protected $description = 'Delete visitor_logs records older than 180 days (6 months) to keep the table lean.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (! Schema::hasTable('visitor_logs')) {
            $this->warn('Table visitor_logs does not exist. Skipping.');
            return self::SUCCESS;
        }

        $days      = (int) $this->option('days');
        $cutoff    = Carbon::now()->subDays($days);
        $threshold = $cutoff->toDateTimeString();

        // Count before deleting so we can report
        $count = DB::table('visitor_logs')
            ->where('created_at', '<', $cutoff)
            ->count();

        if ($count === 0) {
            $this->info("No visitor logs older than {$days} days found. Nothing to delete.");
            return self::SUCCESS;
        }

        DB::table('visitor_logs')
            ->where('created_at', '<', $cutoff)
            ->delete();

        $this->info("✓ Deleted {$count} visitor log(s) older than {$days} days (before {$threshold}).");

        return self::SUCCESS;
    }
}
