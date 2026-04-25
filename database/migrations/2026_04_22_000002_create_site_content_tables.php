<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leadership_members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('initials', 24);
            $table->string('title');
            $table->string('portfolio');
            $table->text('focus');
            $table->string('icon')->default('fa-user-tie');
            $table->string('tone')->default('blue');
            $table->string('photo_path')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('news_updates', function (Blueprint $table) {
            $table->id();
            $table->string('category')->default('Update')->index();
            $table->string('title');
            $table->text('summary');
            $table->longText('body')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('contact_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->index();
            $table->string('phone')->nullable();
            $table->string('inquiry_type')->default('General Inquiry')->index();
            $table->text('message');
            $table->string('status')->default('new')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_inquiries');
        Schema::dropIfExists('news_updates');
        Schema::dropIfExists('leadership_members');
    }
};
