<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('direccion',400);
            $table->point('location');
            $table->boolean('mostrar');
            $table->integer('costoMax')->unsigned();
            $table->integer('costoMin')->unsigned();
            $table->string('descripcion',400);
            $table->integer('trabajador_id')->unsigned();
            $table->foreign('trabajador_id')->references('id')->on('trabajadors');
            $table->timestamps();
        });
        //DB::statement('ALTER TABLE trabajos ADD SPATIAL INDEX (location)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajos');
    }
}
