<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $permissions = [
            ['name' => 'View Payment Details', 'slug' => 'admin.payments.view', 'group' => 'Payments'],
            ['name' => 'Confirm Payments', 'slug' => 'admin.payments.confirm', 'group' => 'Payments'],
            ['name' => 'Verify Payments', 'slug' => 'admin.payments.verify', 'group' => 'Payments'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['slug' => $permission['slug']],
                array_merge($permission, ['created_at' => now(), 'updated_at' => now()])
            );
        }

        $adminRole = DB::table('roles')->where('slug', 'admin')->first();
        if (! $adminRole) {
            return;
        }

        DB::table('permissions')
            ->whereIn('slug', ['admin.payments.view', 'admin.payments.confirm', 'admin.payments.verify'])
            ->pluck('id')
            ->each(function ($permissionId) use ($adminRole): void {
                DB::table('role_permission')->updateOrInsert([
                    'role_id' => $adminRole->id,
                    'permission_id' => $permissionId,
                ]);
            });
    }

    public function down(): void
    {
        $permissionIds = DB::table('permissions')
            ->whereIn('slug', ['admin.payments.view', 'admin.payments.confirm', 'admin.payments.verify'])
            ->pluck('id');

        DB::table('role_permission')->whereIn('permission_id', $permissionIds)->delete();
        DB::table('permissions')->whereIn('id', $permissionIds)->delete();
    }
};
