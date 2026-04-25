<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('membership_profiles', function (Blueprint $table) {
            $table->string('current_address')->nullable()->after('phone');
            $table->string('occupation_type')->nullable()->after('completion_year');
            $table->string('occupation_title')->nullable()->after('occupation_type');
            $table->string('business_name')->nullable()->after('occupation_title');
            $table->string('business_nature')->nullable()->after('business_name');
            $table->string('marital_status')->nullable()->after('business_nature');
            $table->string('payment_phone')->nullable()->after('payment_method');

            $table->index(['occupation_type', 'marital_status']);
        });
    }

    public function down(): void
    {
        Schema::table('membership_profiles', function (Blueprint $table) {
            $table->dropIndex(['occupation_type', 'marital_status']);
            $table->dropColumn([
                'current_address',
                'occupation_type',
                'occupation_title',
                'business_name',
                'business_nature',
                'marital_status',
                'payment_phone',
            ]);
        });
    }
};
