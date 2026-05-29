<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Strict cleanup — exactly 8 pristine English-title subsystems:
 *
 *  1  Dashboard
 *  2  Students
 *  3  Teachers
 *  4  Financials
 *  5  Lesson Tracking
 *  6  Attendance
 *  7  Exam Reports
 *  8  SMS / Announcements   ← was "Messages" (id=32), moved from order=99
 *
 * Removed from active sidebar:
 *  - old placeholder "SMS / Announcements" (id=35, order=8)  → deactivated
 *  - Departments (id=18, order=89)                           → deactivated
 *
 * Swahili bracket suffixes stripped from titles 4-7.
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── 1. Deactivate the old placeholder "SMS / Announcements" (id=35) ──
        DB::table('menus')->where('id', 35)->update(['is_active' => false]);

        // ── 2. Deactivate Departments (id=18) ─────────────────────────────────
        DB::table('menus')->where('id', 18)->update(['is_active' => false]);

        // ── 3. Rename & promote Messages (id=32) → "SMS / Announcements" ──────
        DB::table('menus')->where('id', 32)->update([
            'title'         => 'SMS / Announcements',
            'icon'          => 'fas fa-bullhorn',
            'order'         => 8,
            'active_routes' => json_encode(['messages/list']),
            'updated_at'    => now(),
        ]);

        // ── 4. Strip Swahili brackets from title 4 ────────────────────────────
        DB::table('menus')->where('id', 27)->update([
            'title'      => 'Financials',
            'updated_at' => now(),
        ]);

        // ── 5. Strip Swahili brackets from title 5 ────────────────────────────
        DB::table('menus')->where('id', 21)->update([
            'title'      => 'Lesson Tracking',
            'updated_at' => now(),
        ]);

        // ── 6. Strip Swahili brackets from title 6 ────────────────────────────
        DB::table('menus')->where('id', 33)->update([
            'title'      => 'Attendance',
            'updated_at' => now(),
        ]);

        // ── 7. Strip Swahili brackets from title 7 ────────────────────────────
        DB::table('menus')->where('id', 34)->update([
            'title'      => 'Exam Reports',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        // Restore original titles and states
        DB::table('menus')->where('id', 35)->update(['is_active' => true]);
        DB::table('menus')->where('id', 18)->update(['is_active' => true]);

        DB::table('menus')->where('id', 32)->update([
            'title'         => 'Messages',
            'icon'          => 'fas fa-envelope',
            'order'         => 99,
            'active_routes' => json_encode(['messages/list']),
            'updated_at'    => now(),
        ]);

        DB::table('menus')->where('id', 27)->update(['title' => 'Financials (Ada/Malipo)', 'updated_at' => now()]);
        DB::table('menus')->where('id', 21)->update(['title' => 'Lesson Tracking (Vipindi)', 'updated_at' => now()]);
        DB::table('menus')->where('id', 33)->update(['title' => 'Attendance (Mahudhurio)', 'updated_at' => now()]);
        DB::table('menus')->where('id', 34)->update(['title' => 'Exam Reports (Matokeo)', 'updated_at' => now()]);
    }
};
