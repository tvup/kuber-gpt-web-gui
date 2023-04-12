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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('vpn_type', ['TS', 'FULL'])->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->string('surname')->nullable()->change();
            $table->string('vat_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('vpn_type', ['TS', 'FULL'])->nullable(false)->change();
            $table->string('name')->nullable(false)->change();
            $table->string('surname')->nullable(false)->change();
            $table->string('vat_number')->nullable(false)->change();
        });
    }
};
