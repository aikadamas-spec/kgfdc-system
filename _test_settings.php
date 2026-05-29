<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$path = storage_path('app/settings.json');
echo "File exists: " . (file_exists($path) ? 'YES' : 'NO') . PHP_EOL;
$raw = file_get_contents($path);
$decoded = json_decode($raw, true);
echo "json_last_error: " . json_last_error() . " (" . json_last_error_msg() . ")" . PHP_EOL;
echo "logo: "    . ($decoded['logo']    ?? 'NULL') . PHP_EOL;
echo "favicon: " . ($decoded['favicon'] ?? 'NULL') . PHP_EOL;

// Check if the actual files exist via the symlink
$logoPublic    = public_path('storage/' . ($decoded['logo']    ?? ''));
$faviconPublic = public_path('storage/' . ($decoded['favicon'] ?? ''));
echo "Logo file exists at public/storage: "    . (file_exists($logoPublic)    ? 'YES' : 'NO') . PHP_EOL;
echo "Favicon file exists at public/storage: " . (file_exists($faviconPublic) ? 'YES' : 'NO') . PHP_EOL;
echo "Logo URL: " . asset('storage/' . ($decoded['logo'] ?? 'settings/logo.png')) . PHP_EOL;
