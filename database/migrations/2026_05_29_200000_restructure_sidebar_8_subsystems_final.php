<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Final UI/UX structural upgrade — 8 clean English subsystems:
 *
 *  1  Dashboard
 *  2  Student Management   (was "Students")
 *  3  Staff Management     (was "Teachers")
 *  4  Financials
 *  5  Lesson Tracking
 *  6  Attendance
 *  7  Exam Reports
 *  8  SMS & Alerts         (was "SMS / Announcements")
 *
 * CRITICAL: Student and Teacher CRUD routes are NOT touched.
 * Only parent display titles and child menu items are restructured.
 */
return new class extends Migration
{
    // ── helpers ────────────────────────────────────────────────────────────────

    private function upsertChild(int $parentId, string $title, string $route, int $order): void
    {
        $exists = DB::table('menus')
            ->where('parent_id', $parentId)
            ->where('title', $title)
            ->exists();

        if ($exists) {
            DB::table('menus')
                ->where('parent_id', $parentId)
                ->where('title', $title)
                ->update([
                    'route'         => $route,
                    'active_routes' => json_encode([$route]),
                    'order'         => $order,
                    'is_active'     => true,
                    'updated_at'    => now(),
                ]);
        } else {
            DB::table('menus')->insert([
                'title'         => $title,
                'icon'          => null,
                'route'         => $route,
                'active_routes' => json_encode([$route]),
                'pattern'       => null,
                'parent_id'     => $parentId,
                'order'         => $order,
                'is_active'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }

    private function deactivateChildrenExcept(int $parentId, array $keepTitles): void
    {
        DB::table('menus')
            ->where('parent_id', $parentId)
            ->whereNotIn('title', $keepTitles)
            ->update(['is_active' => false, 'updated_at' => now()]);
    }

    // ── up ─────────────────────────────────────────────────────────────────────

    public function up(): void
    {
        // ══════════════════════════════════════════════════════════════════════
        // 2. Student Management  (rename "Students" → "Student Management")
        // ══════════════════════════════════════════════════════════════════════
        $studentParentId = DB::table('menus')
            ->whereNull('parent_id')
            ->whereIn('title', ['Students', 'Student Management'])
            ->value('id');

        if ($studentParentId) {
            DB::table('menus')->where('id', $studentParentId)->update([
                'title'         => 'Student Management',
                'icon'          => 'fas fa-user-graduate',
                'order'         => 2,
                'active_routes' => json_encode([
                    'student/list',
                    'student/add/page',
                    'student/profile',
                ]),
                'updated_at'    => now(),
            ]);

            // Deactivate any old children that no longer belong
            $this->deactivateChildrenExcept($studentParentId, [
                'Student List', 'Register Student', 'Profiles',
            ]);

            // Insert / update the 3 canonical children
            $this->upsertChild($studentParentId, 'Student List',      'student/list',      1);
            $this->upsertChild($studentParentId, 'Register Student',  'student/add/page',  2);
            $this->upsertChild($studentParentId, 'Profiles',          'student/list',      3);
        }

        // ══════════════════════════════════════════════════════════════════════
        // 3. Staff Management  (rename "Teachers" → "Staff Management")
        // ══════════════════════════════════════════════════════════════════════
        $staffParentId = DB::table('menus')
            ->whereNull('parent_id')
            ->whereIn('title', ['Teachers', 'Staff Management'])
            ->value('id');

        if ($staffParentId) {
            DB::table('menus')->where('id', $staffParentId)->update([
                'title'         => 'Staff Management',
                'icon'          => 'fas fa-chalkboard-teacher',
                'order'         => 3,
                'active_routes' => json_encode([
                    'teacher/list/page',
                    'teacher/add/page',
                ]),
                'updated_at'    => now(),
            ]);

            // Deactivate any old children that no longer belong
            $this->deactivateChildrenExcept($staffParentId, [
                'Staff Directory', 'Add Employee', 'Roles',
            ]);

            // Insert / update the 3 canonical children
            $this->upsertChild($staffParentId, 'Staff Directory', 'teacher/list/page', 1);
            $this->upsertChild($staffParentId, 'Add Employee',    'teacher/add/page',  2);
            $this->upsertChild($staffParentId, 'Roles',           'list/users',        3);
        }

        // ══════════════════════════════════════════════════════════════════════
        // 4. Financials — ensure children match the 3-item spec
        // ══════════════════════════════════════════════════════════════════════
        $financialsId = DB::table('menus')
            ->whereNull('parent_id')
            ->where('title', 'Financials')
            ->value('id');

        if ($financialsId) {
            // Deactivate old children not in the new spec
            $this->deactivateChildrenExcept($financialsId, [
                'Invoices', 'Receipts', 'Student Balances',
            ]);

            $this->upsertChild($financialsId, 'Invoices',         'invoice/list/page',  1);
            $this->upsertChild($financialsId, 'Receipts',         'invoice/list/page',  2);
            $this->upsertChild($financialsId, 'Student Balances', 'invoice/list/page',  3);
        }

        // ══════════════════════════════════════════════════════════════════════
        // 5. Lesson Tracking — 3 children
        // ══════════════════════════════════════════════════════════════════════
        $lessonId = DB::table('menus')
            ->whereNull('parent_id')
            ->where('title', 'Lesson Tracking')
            ->value('id');

        if ($lessonId) {
            $this->deactivateChildrenExcept($lessonId, [
                'Log Lesson', 'Audit Logs', 'Syllabus Coverage',
            ]);

            $this->upsertChild($lessonId, 'Log Lesson',       '#', 1);
            $this->upsertChild($lessonId, 'Audit Logs',       '#', 2);
            $this->upsertChild($lessonId, 'Syllabus Coverage','#', 3);
        }

        // ══════════════════════════════════════════════════════════════════════
        // 6. Attendance — 2 children
        // ══════════════════════════════════════════════════════════════════════
        $attendanceId = DB::table('menus')
            ->whereNull('parent_id')
            ->where('title', 'Attendance')
            ->value('id');

        if ($attendanceId) {
            $this->deactivateChildrenExcept($attendanceId, [
                'Take Attendance', 'Attendance Reports',
            ]);

            $this->upsertChild($attendanceId, 'Take Attendance',    '#', 1);
            $this->upsertChild($attendanceId, 'Attendance Reports', '#', 2);
        }

        // ══════════════════════════════════════════════════════════════════════
        // 7. Exam Reports — 3 children
        // ══════════════════════════════════════════════════════════════════════
        $examId = DB::table('menus')
            ->whereNull('parent_id')
            ->where('title', 'Exam Reports')
            ->value('id');

        if ($examId) {
            $this->deactivateChildrenExcept($examId, [
                'Enter Marks', 'Process Results', 'Report Cards',
            ]);

            $this->upsertChild($examId, 'Enter Marks',     '#', 1);
            $this->upsertChild($examId, 'Process Results', '#', 2);
            $this->upsertChild($examId, 'Report Cards',    '#', 3);
        }

        // ══════════════════════════════════════════════════════════════════════
        // 8. SMS & Alerts  (rename "SMS / Announcements" → "SMS & Alerts")
        // ══════════════════════════════════════════════════════════════════════
        $smsId = DB::table('menus')
            ->whereNull('parent_id')
            ->whereIn('title', ['SMS / Announcements', 'SMS & Alerts'])
            ->value('id');

        if ($smsId) {
            DB::table('menus')->where('id', $smsId)->update([
                'title'      => 'SMS & Alerts',
                'icon'       => 'fas fa-sms',
                'order'      => 8,
                'updated_at' => now(),
            ]);

            $this->deactivateChildrenExcept($smsId, [
                'Bulk SMS', 'Notice Board',
            ]);

            $this->upsertChild($smsId, 'Bulk SMS',     '#', 1);
            $this->upsertChild($smsId, 'Notice Board', '#', 2);
        }
    }

    // ── down ───────────────────────────────────────────────────────────────────

    public function down(): void
    {
        // Restore parent titles
        DB::table('menus')
            ->whereNull('parent_id')
            ->where('title', 'Student Management')
            ->update(['title' => 'Students', 'updated_at' => now()]);

        DB::table('menus')
            ->whereNull('parent_id')
            ->where('title', 'Staff Management')
            ->update(['title' => 'Teachers', 'updated_at' => now()]);

        DB::table('menus')
            ->whereNull('parent_id')
            ->where('title', 'SMS & Alerts')
            ->update(['title' => 'SMS / Announcements', 'updated_at' => now()]);

        // Remove children added by this migration
        $titlesToRemove = [
            'Student List', 'Register Student', 'Profiles',
            'Staff Directory', 'Add Employee', 'Roles',
            'Invoices', 'Receipts', 'Student Balances',
            'Log Lesson', 'Audit Logs', 'Syllabus Coverage',
            'Take Attendance', 'Attendance Reports',
            'Enter Marks', 'Process Results', 'Report Cards',
            'Bulk SMS', 'Notice Board',
        ];

        DB::table('menus')
            ->whereIn('title', $titlesToRemove)
            ->whereNotNull('parent_id')
            ->delete();
    }
};
