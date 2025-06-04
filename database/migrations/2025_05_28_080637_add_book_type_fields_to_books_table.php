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
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            
            $table->string('education_level')->nullable();
            $table->integer('grade')->nullable();
            $table->string('curriculum')->nullable();
            $table->string('fiction_category')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained();
            
            $table->dropColumn([
                'education_level',
                'grade',
                'curriculum',
                'fiction_category',
            ]);
        });
    }
};
