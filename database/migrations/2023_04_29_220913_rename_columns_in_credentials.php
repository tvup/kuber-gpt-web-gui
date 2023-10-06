<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\StringType;

return new class extends Migration
{
    public function __construct()
    {
        if (! Type::hasType('enum')) {
            Type::addType('enum', StringType::class);
        }
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('credentials', function (Blueprint $table) {
            $table->dropColumn('expires_at');});
        Schema::table('credentials', function (Blueprint $table) {
            $table->dropColumn('revoked_at');});
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('user_id', 'credentials_set_id');});
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('status', 'credential_type');});
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('idcert', 'name');});
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('cert', 'key');});
        Schema::table('credentials', function (Blueprint $table) {
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
            $table->renameColumn('value', 'link_conf');});
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('key', 'cert');});
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('name', 'idcert');});
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('credentials_set_id', 'user_id');});
        Schema::table('credentials', function (Blueprint $table) {
            $table->enum('status', ['valid','revoked','expired'])->nullable()->change();});
        Schema::table('credentials', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable();});
        Schema::table('credentials', function (Blueprint $table) {
            $table->timestamp('revoked_at')->nullable();
        });
    }
};
