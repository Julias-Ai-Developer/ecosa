<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('membership_profiles', function (Blueprint $table) {
            $table->string('payment_purpose')->default('membership')->after('payment_status')->index();
        });
    }

    public function down(): void
    {
        Schema::table('membership_profiles', function (Blueprint $table) {
            $table->dropIndex(['payment_purpose']);
            $table->dropColumn('payment_purpose');
        });
    }
};
