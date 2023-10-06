<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\StringType;

class CreateCertificatiTable extends Migration
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
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificati', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('stato', ['V', 'R']);
            $table->timestamp('dt_scadenza')->nullable();
            $table->timestamp('dt_revoca')->nullable();
            $table->string('idcert')->nullable();
            $table->string('cert')->nullable();
            $table->string('user')->nullable();
            $table->string('link_conf')->nullable();

            $table->integer('user_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificati');
    }
}
