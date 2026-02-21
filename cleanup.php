<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

use Illuminate\Support\Facades\DB;

$app->make(\Illuminate\Contracts\Http\Kernel::class);

// Drop table guru_mapel jika ada
try {
    DB::statement('DROP TABLE IF EXISTS guru_mapel');
    echo "✓ Dropped table guru_mapel\n";
} catch (\Exception $e) {
    echo "✗ Error dropping guru_mapel: " . $e->getMessage() . "\n";
}

// Drop table kelas jika ada (untuk reset clean)
try {
    DB::statement('DROP TABLE IF EXISTS kelas');
    echo "✓ Dropped table kelas\n";
} catch (\Exception $e) {
    echo "✗ Error dropping kelas: " . $e->getMessage() . "\n";
}

// Hapus migration records
try {
    DB::table('migrations')->where('migration', 'like', '%kelas%')->delete();
    DB::table('migrations')->where('migration', 'like', '%guru_mapel%')->delete();
    DB::table('migrations')->where('migration', 'like', '%mapels%')->delete();
    echo "✓ Cleared migration records\n";
} catch (\Exception $e) {
    echo "✗ Error clearing migrations: " . $e->getMessage() . "\n";
}

echo "\nDone! Now run: php artisan migrate\n";
