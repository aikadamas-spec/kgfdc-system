<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Reorder and rename sidebar menus to match the canonical 8-subsystem layout:
 *
 *  1  Dashboard
 *  2  Students
 *  3  Teachers
 *  4  Financials (Ada/Malipo)   ← merges old Invoices + Accounts
 *  5  Lesson Tracking (Vipindi) ← was Subjects
 *  6  Attendance (Mahudhurio)   ← new placeholder
 *  7  Exam Reports (Matokeo)    ← new placeholder
 *  8  SMS / Announcements       ← new placeholder
 * 90  User Management           ← admin-only, kept at bottom
 * 91  Settings                  ← super-admin-only, kept at bottom
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── 1. Dashboard → order 1 (already exists, just ensure order) ────────
        DB::table('menus')
            ->where('title', 'Dashboard')
            ->whereNull('parent_id')
            ->update(['order' => 1]);

        // ── 2. Students → order 2 ─────────────────────────────────────────────
        DB::table('menus')
            ->where('title', 'Students')
            ->whereNull('parent_id')
            ->update(['order' => 2]);

        // ── 3. Teachers → order 3 ─────────────────────────────────────────────
        DB::table('menus')
            ->where('title', 'Teachers')
            ->whereNull('parent_id')
            ->update(['order' => 3]);

        // ── 4. Financials (Ada/Malipo) → order 4 ──────────────────────────────
        //    Rename old "Accounts" parent to "Financials (Ada/Malipo)" and move
        //    the old "Invoices" children under it. Then hide the bare Invoices
        //    parent so only one "Financials" entry appears.
        $financialsId = DB::table('menus')
            ->where('title', 'Accounts')
            ->whereNull('parent_id')
            ->value('id');

        if ($financialsId) {
            DB::table('menus')
                ->where('id', $financialsId)
                ->update([
                    'title'         => 'Financials (Ada/Malipo)',
                    'icon'          => 'fas fa-money-bill-wave',
                    'order'         => 4,
                    'active_routes' => json_encode([
                        'invoice/list/page',
                        'invoice/add/page',
                        'account/fees/collections/page',
                        'add/fees/collection/page',
                    ]),
                ]);

            // Re-parent Invoices children under Financials
            $invoicesParentId = DB::table('menus')
                ->where('title', 'Invoices')
                ->whereNull('parent_id')
                ->value('id');

            if ($invoicesParentId) {
                // Move invoice children under Financials
                DB::table('menus')
                    ->where('parent_id', $invoicesParentId)
                    ->update(['parent_id' => $financialsId]);

                // Deactivate the now-empty Invoices parent
                DB::table('menus')
                    ->where('id', $invoicesParentId)
                    ->update(['is_active' => false]);
            }

            // Ensure existing Accounts children keep their parent
            // (they already point to $financialsId — no change needed)
        } else {
            // Financials parent doesn't exist yet — create it fresh
            $financialsId = DB::table('menus')->insertGetId([
                'title'         => 'Financials (Ada/Malipo)',
                'icon'          => 'fas fa-money-bill-wave',
                'route'         => null,
                'active_routes' => json_encode([
                    'invoice/list/page',
                    'invoice/add/page',
                    'account/fees/collections/page',
                    'add/fees/collection/page',
                ]),
                'pattern'       => null,
                'parent_id'     => null,
                'order'         => 4,
                'is_active'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            DB::table('menus')->insert([
                [
                    'title'         => 'Invoices List',
                    'icon'          => null,
                    'route'         => 'invoice/list/page',
                    'active_routes' => json_encode(['invoice/list/page']),
                    'pattern'       => null,
                    'parent_id'     => $financialsId,
                    'order'         => 1,
                    'is_active'     => true,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],
                [
                    'title'         => 'Add Invoice',
                    'icon'          => null,
                    'route'         => 'invoice/add/page',
                    'active_routes' => json_encode(['invoice/add/page']),
                    'pattern'       => null,
                    'parent_id'     => $financialsId,
                    'order'         => 2,
                    'is_active'     => true,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],
                [
                    'title'         => 'Fees Collection',
                    'icon'          => null,
                    'route'         => 'account/fees/collections/page',
                    'active_routes' => json_encode(['account/fees/collections/page']),
                    'pattern'       => null,
                    'parent_id'     => $financialsId,
                    'order'         => 3,
                    'is_active'     => true,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],
                [
                    'title'         => 'Add Fees',
                    'icon'          => null,
                    'route'         => 'add/fees/collection/page',
                    'active_routes' => json_encode(['add/fees/collection/page']),
                    'pattern'       => null,
                    'parent_id'     => $financialsId,
                    'order'         => 4,
                    'is_active'     => true,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],
            ]);
        }

        // ── 5. Lesson Tracking (Vipindi) → order 5 ────────────────────────────
        //    Rename old "Subjects" to "Lesson Tracking (Vipindi)"
        $lessonId = DB::table('menus')
            ->where('title', 'Subjects')
            ->whereNull('parent_id')
            ->value('id');

        if ($lessonId) {
            DB::table('menus')
                ->where('id', $lessonId)
                ->update([
                    'title' => 'Lesson Tracking (Vipindi)',
                    'icon'  => 'fas fa-book-open',
                    'order' => 5,
                ]);
        } else {
            DB::table('menus')->insertGetId([
                'title'         => 'Lesson Tracking (Vipindi)',
                'icon'          => 'fas fa-book-open',
                'route'         => null,
                'active_routes' => json_encode([]),
                'pattern'       => null,
                'parent_id'     => null,
                'order'         => 5,
                'is_active'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }

        // ── 6. Attendance (Mahudhurio) → order 6 ──────────────────────────────
        if (DB::table('menus')->where('title', 'Attendance (Mahudhurio)')->whereNull('parent_id')->doesntExist()) {
            DB::table('menus')->insert([
                'title'         => 'Attendance (Mahudhurio)',
                'icon'          => 'fas fa-clipboard-check',
                'route'         => null,
                'active_routes' => json_encode([]),
                'pattern'       => null,
                'parent_id'     => null,
                'order'         => 6,
                'is_active'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        } else {
            DB::table('menus')
                ->where('title', 'Attendance (Mahudhurio)')
                ->whereNull('parent_id')
                ->update(['order' => 6]);
        }

        // ── 7. Exam Reports (Matokeo) → order 7 ───────────────────────────────
        if (DB::table('menus')->where('title', 'Exam Reports (Matokeo)')->whereNull('parent_id')->doesntExist()) {
            DB::table('menus')->insert([
                'title'         => 'Exam Reports (Matokeo)',
                'icon'          => 'fas fa-chart-bar',
                'route'         => null,
                'active_routes' => json_encode([]),
                'pattern'       => null,
                'parent_id'     => null,
                'order'         => 7,
                'is_active'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        } else {
            DB::table('menus')
                ->where('title', 'Exam Reports (Matokeo)')
                ->whereNull('parent_id')
                ->update(['order' => 7]);
        }

        // ── 8. SMS / Announcements → order 8 ──────────────────────────────────
        if (DB::table('menus')->where('title', 'SMS / Announcements')->whereNull('parent_id')->doesntExist()) {
            DB::table('menus')->insert([
                'title'         => 'SMS / Announcements',
                'icon'          => 'fas fa-bullhorn',
                'route'         => null,
                'active_routes' => json_encode([]),
                'pattern'       => null,
                'parent_id'     => null,
                'order'         => 8,
                'is_active'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        } else {
            DB::table('menus')
                ->where('title', 'SMS / Announcements')
                ->whereNull('parent_id')
                ->update(['order' => 8]);
        }

        // ── Admin-only items pushed to the bottom ──────────────────────────────
        DB::table('menus')
            ->where('title', 'Departments')
            ->whereNull('parent_id')
            ->update(['order' => 89]);

        DB::table('menus')
            ->where('title', 'User Management')
            ->whereNull('parent_id')
            ->update(['order' => 90]);

        DB::table('menus')
            ->where('title', 'Settings')
            ->whereNull('parent_id')
            ->update(['order' => 91]);

        // Messages (contact inbox) stays at 99 as seeded
    }

    public function down(): void
    {
        // Restore original order values from the initial seed migration
        $restores = [
            ['title' => 'Dashboard',                  'order' => 1],
            ['title' => 'User Management',             'order' => 2],
            ['title' => 'Settings',                    'order' => 3],
            ['title' => 'Students',                    'order' => 4],
            ['title' => 'Teachers',                    'order' => 5],
            ['title' => 'Departments',                 'order' => 6],
            ['title' => 'Subjects',                    'order' => 7],  // will be renamed back below
            ['title' => 'Lesson Tracking (Vipindi)',   'order' => 7],
            ['title' => 'Invoices',                    'order' => 8],
            ['title' => 'Accounts',                    'order' => 9],  // will be renamed back below
            ['title' => 'Financials (Ada/Malipo)',     'order' => 9],
        ];

        foreach ($restores as $r) {
            DB::table('menus')
                ->where('title', $r['title'])
                ->whereNull('parent_id')
                ->update(['order' => $r['order']]);
        }

        // Rename back
        DB::table('menus')
            ->where('title', 'Lesson Tracking (Vipindi)')
            ->whereNull('parent_id')
            ->update(['title' => 'Subjects', 'icon' => 'fas fa-book-reader']);

        DB::table('menus')
            ->where('title', 'Financials (Ada/Malipo)')
            ->whereNull('parent_id')
            ->update(['title' => 'Accounts', 'icon' => 'fas fa-file-invoice-dollar']);

        // Re-activate Invoices parent
        DB::table('menus')
            ->where('title', 'Invoices')
            ->whereNull('parent_id')
            ->update(['is_active' => true]);

        // Remove placeholder items added by this migration
        DB::table('menus')
            ->whereIn('title', ['Attendance (Mahudhurio)', 'Exam Reports (Matokeo)', 'SMS / Announcements'])
            ->whereNull('parent_id')
            ->delete();
    }
};
