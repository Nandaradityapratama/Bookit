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
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'slug')) {
                $table->string('slug')->unique()->nullable();
            }
            if (!Schema::hasColumn('books', 'type')) {
                $table->string('type')->nullable(); // 'textbook' atau 'fiction'
            }
            if (!Schema::hasColumn('books', 'author')) {
                $table->string('author')->nullable();
            }
            if (!Schema::hasColumn('books', 'image_path')) {
                $table->string('image_path')->nullable();
            }
            if (!Schema::hasColumn('books', 'pdf_path')) {
                $table->string('pdf_path')->nullable();
            }
            if (!Schema::hasColumn('books', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'type',
                'author',
                'image_path',
                'pdf_path',
                'description'
            ]);
        });
    }
}; 