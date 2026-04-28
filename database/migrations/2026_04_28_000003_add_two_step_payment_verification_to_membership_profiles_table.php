<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('membership_profiles', function (Blueprint $table) {
            $table->foreignId('payment_confirmed_by')->nullable()->after('payment_reference')->constrained('users')->nullOnDelete();
            $table->timestamp('payment_confirmed_at')->nullable()->after('payment_confirmed_by');
            $table->foreignId('payment_verified_by')->nullable()->after('payment_confirmed_at')->constrained('users')->nullOnDelete();
            $table->timestamp('payment_verified_at')->nullable()->after('payment_verified_by');
        });
    }

    public function down(): void
    {
        Schema::table('membership_profiles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('payment_confirmed_by');
            $table->dropColumn('payment_confirmed_at');
            $table->dropConstrainedForeignId('payment_verified_by');
            $table->dropColumn('payment_verified_at');
        });
    }
};
