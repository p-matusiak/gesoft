<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 180)->unique();
            $table->string('category', 32)->index();
            $table->string('status', 16)->default('published')->index();
            $table->string('source', 16)->default('static')->index();
            $table->string('topic_key', 80)->nullable()->index();
            $table->date('published_at')->index();
            $table->unsignedTinyInteger('read_time')->default(12);
            $table->json('related_projects')->nullable();
            $table->json('related_slugs')->nullable();
            $table->json('pl');
            $table->json('en');
            $table->string('news_url', 500)->nullable();
            $table->string('news_title', 300)->nullable();
            $table->unsignedInteger('chars_pl')->default(0);
            $table->timestamp('generated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
