<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbilityPokemonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abilitypokemon', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            
            $table->bigIncrements('id');
            $table->bigInteger('idability')->unsigned()->index();
            $table->bigInteger('idpokemon')->unsigned()->index();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['idability', 'idpokemon']);
            
            $table->foreign('idability')->references('id')->on('ability');
            $table->foreign('idpokemon')->references('id')->on('pokemon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abilitypokemon');
    }
}
