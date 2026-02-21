<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanDatabase extends Command
{
    protected $signature = 'db:clean';
    protected $description = 'Drop problematic tables and migration records';

    public function handle()
    {
        $this->info('Dropping tables...');
        
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::statement('DROP TABLE IF EXISTS guru_mapel');
            DB::statement('DROP TABLE IF EXISTS kelas');
            DB::statement('DROP TABLE IF EXISTS mapels');
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            $this->info('✓ Tables dropped');
        } catch (\Exception $e) {
            $this->error('✗ Error: ' . $e->getMessage());
            return 1;
        }

        $this->info('Clearing migration records...');
        try {
            DB::table('migrations')
                ->whereIn('migration', [
                    '2026_01_22_175923_create_kelas_table',
                    '2026_02_16_040903_create_mapels_table',
                    '2026_02_16_041022_create_guru_mapel_table',
                    '2026_02_17_120000_fix_guru_mapel_table',
                    '2026_02_17_150000_remove_kelas_id_from_guru_mapel',
                ])
                ->delete();
            $this->info('✓ Migration records cleared');
        } catch (\Exception $e) {
            $this->error('✗ Error: ' . $e->getMessage());
            return 1;
        }

        $this->info('Done! Run: php artisan migrate');
        return 0;
    }
}
