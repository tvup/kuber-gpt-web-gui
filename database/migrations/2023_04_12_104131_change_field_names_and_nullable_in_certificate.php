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
        Schema::table('certificates', function (Blueprint $table) {
            $table->renameColumn('stato', 'status');});
        Schema::table('certificates', function (Blueprint $table) {
            $table->renameColumn('dt_scadenza', 'expires_at');});
        Schema::table('certificates', function (Blueprint $table) {
            $table->renameColumn('dt_revoca', 'revoked_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->renameColumn('status', 'stato');});
        Schema::table('certificates', function (Blueprint $table) {
            $table->renameColumn('expires_at', 'dt_scadenza');});
        Schema::table('certificates', function (Blueprint $table) {
            $table->renameColumn('revoked_at', 'dt_revoca');
        });
    }
};
