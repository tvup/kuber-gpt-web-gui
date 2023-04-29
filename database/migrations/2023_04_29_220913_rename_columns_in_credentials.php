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
        Schema::table('credentials', function (Blueprint $table) {
            $table->dropColumn('expires_at');
            $table->dropColumn('revoked_at');
            $table->renameColumn('user_id', 'credentials_set_id');
            $table->renameColumn('status', 'credential_type');
            $table->renameColumn('idcert', 'name');
            $table->renameColumn('cert', 'key');
            $table->renameColumn('link_conf', 'value');
        });
        Schema::table('credentials', function (Blueprint $table) {
            $table->enum('credential_type', ['valid','revoked','expired'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('credential_type', 'status');
        });
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('value', 'link_conf');
            $table->renameColumn('key', 'cert');
            $table->renameColumn('name', 'idcert');
            $table->renameColumn('credentials_set_id', 'user_id');
            $table->enum('status', ['valid','revoked','expired'])->nullable()->change();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('revoked_at')->nullable();
        });
    }
};
