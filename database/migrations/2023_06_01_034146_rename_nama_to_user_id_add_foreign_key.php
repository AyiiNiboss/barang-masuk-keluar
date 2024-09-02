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
        // Cek apakah kolom 'users_id' sudah ada sebelumnya
        if (!Schema::hasColumn('sementara', 'users_id')) {
            Schema::table('sementara', function (Blueprint $table) {
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sementara', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
        });
    }
};
