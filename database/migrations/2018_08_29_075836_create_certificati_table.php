<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatiTable extends Migration
{
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
