<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->boolean('is_system')->default(false);
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        Schema::create('role_permission', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained()->cascadeOnDelete();
            $table->primary(['role_id', 'permission_id']);
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->primary(['user_id', 'role_id']);
        });

        // Seed default permissions
        $permissions = [
            ['name' => 'View Dashboard',       'slug' => 'admin.dashboard',     'group' => 'Overview'],
            ['name' => 'Manage News',          'slug' => 'admin.news',           'group' => 'Content'],
            ['name' => 'Manage Community',     'slug' => 'admin.community',      'group' => 'Content'],
            ['name' => 'Manage Team',          'slug' => 'admin.team',           'group' => 'Content'],
            ['name' => 'View Members',         'slug' => 'admin.members',        'group' => 'Members'],
            ['name' => 'View Messages',        'slug' => 'admin.messages',       'group' => 'Members'],
            ['name' => 'Send Notifications',   'slug' => 'admin.notifications',  'group' => 'Members'],
            ['name' => 'Manage Roles',         'slug' => 'admin.roles',          'group' => 'System'],
            ['name' => 'View Payment Details',  'slug' => 'admin.payments.view',  'group' => 'Payments'],
            ['name' => 'Confirm Payments',      'slug' => 'admin.payments.confirm', 'group' => 'Payments'],
            ['name' => 'Verify Payments',       'slug' => 'admin.payments.verify', 'group' => 'Payments'],
        ];

        DB::table('permissions')->insert(array_map(fn ($p) => array_merge($p, [
            'created_at' => now(),
            'updated_at' => now(),
        ]), $permissions));

        // Seed system roles
        $adminRoleId = DB::table('roles')->insertGetId([
            'name' => 'Administrator',
            'slug' => 'admin',
            'description' => 'Full access to all system features',
            'is_system' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $memberRoleId = DB::table('roles')->insertGetId([
            'name' => 'Member',
            'slug' => 'member',
            'description' => 'Standard member access — portal only',
            'is_system' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin gets all permissions
        $permissionIds = DB::table('permissions')->pluck('id');
        foreach ($permissionIds as $pid) {
            DB::table('role_permission')->insert(['role_id' => $adminRoleId, 'permission_id' => $pid]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};
