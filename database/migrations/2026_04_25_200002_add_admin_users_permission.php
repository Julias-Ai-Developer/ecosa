<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add the Users management permission
        $permissionId = DB::table('permissions')->insertGetId([
            'name'       => 'Users',
            'slug'       => 'admin.users',
            'group'      => 'System',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Attach to admin role
        $adminRole = DB::table('roles')->where('slug', 'admin')->first();
        if ($adminRole) {
            DB::table('role_permission')->insert([
                'role_id'       => $adminRole->id,
                'permission_id' => $permissionId,
            ]);
        }
    }

    public function down(): void
    {
        $permission = DB::table('permissions')->where('slug', 'admin.users')->first();
        if ($permission) {
            DB::table('role_permission')->where('permission_id', $permission->id)->delete();
            DB::table('permissions')->where('id', $permission->id)->delete();
        }
    }
};
