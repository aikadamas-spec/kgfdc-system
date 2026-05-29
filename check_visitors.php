<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== visitor_logs table ===" . PHP_EOL;
$total = DB::table('visitor_logs')->count();
echo "Total rows: " . $total . PHP_EOL;

$sample = DB::table('visitor_logs')->orderByDesc('id')->limit(5)->get(['id','session_id','ip_address','url_visited','last_activity','created_at']);
foreach ($sample as $r) {
    echo "  id={$r->id} | session=" . substr($r->session_id,0,20) . "... | ip={$r->ip_address} | url={$r->url_visited} | last_activity={$r->last_activity} | created={$r->created_at}" . PHP_EOL;
}

echo PHP_EOL . "=== site_settings ===" . PHP_EOL;
if (Schema::hasTable('site_settings')) {
    $rows = DB::table('site_settings')->get();
    foreach ($rows as $r) {
        echo "  key={$r->key} | value={$r->value}" . PHP_EOL;
    }
} else {
    echo "  site_settings table does NOT exist!" . PHP_EOL;
}

echo PHP_EOL . "=== Counts (what AppServiceProvider computes) ===" . PHP_EOL;
use Carbon\Carbon;
$onlineCount = DB::table('visitor_logs')
    ->where('last_activity', '>=', Carbon::now()->subMinutes(5))
    ->distinct('session_id')->count('session_id');
echo "Online now (last 5 min): " . $onlineCount . PHP_EOL;

$todayCount = DB::table('visitor_logs')
    ->whereBetween('created_at', [Carbon::today(), Carbon::now()])
    ->distinct('session_id')->count('session_id');
echo "Today: " . $todayCount . PHP_EOL;

$weeklyCount = DB::table('visitor_logs')
    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])
    ->distinct('session_id')->count('session_id');
echo "This week: " . $weeklyCount . PHP_EOL;

$monthlyCount = DB::table('visitor_logs')
    ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()])
    ->distinct('session_id')->count('session_id');
echo "This month: " . $monthlyCount . PHP_EOL;

echo PHP_EOL . "=== Unique constraint check ===" . PHP_EOL;
$indexes = DB::select("SHOW INDEX FROM visitor_logs");
foreach ($indexes as $idx) {
    echo "  Key={$idx->Key_name} | Column={$idx->Column_name} | Unique=" . ($idx->Non_unique == 0 ? 'YES' : 'NO') . PHP_EOL;
}

echo PHP_EOL . "=== Cache driver ===" . PHP_EOL;
echo "CACHE_DRIVER=" . config('cache.default') . PHP_EOL;

echo PHP_EOL . "=== Session driver ===" . PHP_EOL;
echo "SESSION_DRIVER=" . config('session.driver') . PHP_EOL;

echo PHP_EOL . "=== TrackVisitors: what paths are skipped? ===" . PHP_EOL;
echo "Frontend homepage path: '/' -> path() returns '' (empty string)" . PHP_EOL;
echo "Skip prefixes checked: home, login, register, logout, admin, dashboard, student/, teacher/, ..." . PHP_EOL;
echo "Empty string '' does NOT match any prefix -> frontend IS tracked" . PHP_EOL;
