<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $permissions = [
            ['name' => 'Manage Chapters', 'slug' => 'admin.chapters', 'group' => 'Community'],
            ['name' => 'Manage Resources', 'slug' => 'admin.resources', 'group' => 'Content'],
        ];

        foreach ($permissions as $permission) {
            $permissionId = DB::table('permissions')->updateOrInsert(
                ['slug' => $permission['slug']],
                array_merge($permission, ['created_at' => now(), 'updated_at' => now()])
            );
        }

        $adminRole = DB::table('roles')->where('slug', 'admin')->first();
        if (! $adminRole) {
            return;
        }

        DB::table('permissions')
            ->whereIn('slug', ['admin.chapters', 'admin.resources'])
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
            ->whereIn('slug', ['admin.chapters', 'admin.resources'])
            ->pluck('id');

        DB::table('role_permission')->whereIn('permission_id', $permissionIds)->delete();
        DB::table('permissions')->whereIn('id', $permissionIds)->delete();
    }
};
