<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nisn')->nullable()->unique()->after('id');
        });

        // Update existing users dengan NISN default
        if (Schema::hasTable('users')) {
            $users = DB::table('users')->whereNull('nisn')->get();
            foreach ($users as $user) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['nisn' => 'TEMP-' . str_pad($user->id, 8, '0', STR_PAD_LEFT)]);
            }
        }

        // Setelah semua user memiliki NISN, kita set kolom menjadi NOT NULL
        Schema::table('users', function (Blueprint $table) {
            $table->string('nisn')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nisn');
        });
    }
}; 