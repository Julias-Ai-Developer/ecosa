<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->enum('target_type', ['all', 'specific'])->default('all');
            $table->foreignId('member_profile_id')->nullable()->constrained('membership_profiles')->nullOnDelete();
            $table->foreignId('sent_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('member_notification_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->constrained('member_notifications')->cascadeOnDelete();
            $table->foreignId('member_profile_id')->constrained('membership_profiles')->cascadeOnDelete();
            $table->timestamp('read_at')->useCurrent();
            $table->unique(['notification_id', 'member_profile_id'], 'mnr_notification_member_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_notification_reads');
        Schema::dropIfExists('member_notifications');
    }
};
