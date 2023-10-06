<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RearrangeUserTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('rule', 'role');
            $table->string('nome')->nullable()->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'user_name');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('nome', 'name');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('cognome', 'surname');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('societa', 'company');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('tipo_vpn', 'vpn_type');
        });
        if(false) {
            DB::statement('ALTER TABLE users MODIFY COLUMN created_at timestamp AFTER locale');
        }
        if(false) {
            DB::statement('ALTER TABLE users MODIFY COLUMN updated_at timestamp AFTER created_at');
        }
    }

    public function down(): void
    {
        if(false) {
            DB::statement('ALTER TABLE users MODIFY COLUMN created_at timestamp AFTER remember_token');
        }
        if(false) {
            DB::statement('ALTER TABLE users MODIFY COLUMN updated_at timestamp AFTER created_at');
        }
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('vpn_type', 'tipo_vpn');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('company', 'societa');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('surname', 'cognome');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'nome');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('nome')->nullable(false)->change();
            $table->renameColumn('user_name', 'name');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('role', 'rule');
        });
    }
}
