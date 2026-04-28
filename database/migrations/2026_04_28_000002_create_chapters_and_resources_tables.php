<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->default('regional')->index();
            $table->string('profession')->nullable()->index();
            $table->string('business_sector')->nullable()->index();
            $table->string('region')->nullable()->index();
            $table->string('whatsapp_link')->nullable();
            $table->text('description');
            $table->text('reason')->nullable();
            $table->string('status')->default('pending')->index();
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });

        Schema::create('chapter_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained()->cascadeOnDelete();
            $table->foreignId('membership_profile_id')->constrained()->cascadeOnDelete();
            $table->string('status')->default('pending')->index();
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();

            $table->unique('membership_profile_id');
            $table->unique(['chapter_id', 'membership_profile_id'], 'chapter_member_unique');
        });

        Schema::create('resource_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('category')->default('documentation')->index();
            $table->text('summary')->nullable();
            $table->string('file_path')->nullable();
            $table->string('external_url')->nullable();
            $table->string('media_type')->default('document')->index();
            $table->boolean('is_published')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resource_documents');
        Schema::dropIfExists('chapter_memberships');
        Schema::dropIfExists('chapters');
    }
};
