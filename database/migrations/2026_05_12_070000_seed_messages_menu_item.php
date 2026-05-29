<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Only insert if not already present
        if (DB::table('menus')->where('route', 'messages/list')->doesntExist()) {
            DB::table('menus')->insert([
                'title'        => 'Messages',
                'icon'         => 'fas fa-envelope',
                'route'        => 'messages/list',
                'active_routes'=> json_encode(['messages/list']),
                'pattern'      => 'messages/*',
                'parent_id'    => null,
                'order'        => 99,
                'is_active'    => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('menus')->where('route', 'messages/list')->delete();
    }
};
