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
        Schema::table('server_assets', function (Blueprint $table) {
            $table->json('applications')->nullable()->change();
            $table->json('tags')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('server_assets', function (Blueprint $table) {
            $table->text('applications')->nullable()->change();
            $table->text('tags')->nullable()->change();
        });
    }
};
