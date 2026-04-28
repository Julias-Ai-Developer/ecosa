<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leadership_members', function (Blueprint $table) {
            $table->string('group')->default('top_management')->index()->after('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('leadership_members', function (Blueprint $table) {
            $table->dropColumn('group');
        });
    }
};
