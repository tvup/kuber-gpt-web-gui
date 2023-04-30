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
        Schema::table('credentials_sets', function (Blueprint $table) {
            $table->dropColumn('run_set_id')->nullable();
        });
        Schema::table('run_sets', function (Blueprint $table) {
            $table->bigInteger('credentials_set_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('run_sets', function (Blueprint $table) {
            $table->dropColumn('credentials_set_id');
        });
        Schema::table('credentials_sets', function (Blueprint $table) {
            $table->bigInteger('run_set_id')->nullable();
        });
    }
};
