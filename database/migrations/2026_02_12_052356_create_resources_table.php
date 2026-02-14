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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();

            // Make sub_circle_id nullable - this is the key change!
            $table->foreignId('sub_circle_id')
                ->nullable()  // Add this to make it optional
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('circle_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade'); // Admin who posted

            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['audio', 'video', 'pdf', 'image', 'document', 'other']);
            $table->string('file_path')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->string('external_url')->nullable();
            $table->string('duration')->nullable();
            $table->integer('episodes')->nullable();
            $table->integer('chapters')->nullable();
            $table->string('file_size')->nullable();
            $table->integer('pages')->nullable();
            $table->integer('total_files')->nullable();
            $table->integer('categories_count')->nullable();
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->date('published_date')->nullable();
            $table->string('language')->default('English');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
