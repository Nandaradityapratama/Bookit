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
        Schema::table('borrowings', function (Blueprint $table) {
            $table->string('borrower_name')->nullable();
            $table->string('nisn')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('book_title')->nullable();
            $table->string('book_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn([
                'borrower_name',
                'nisn',
                'phone_number',
                'book_title',
                'book_number'
            ]);
        });
    }
}; 