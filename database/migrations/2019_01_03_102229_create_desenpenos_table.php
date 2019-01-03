<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDesenpenosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('desenpenos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('objetivo1')->nullable();
			$table->string('meta1')->nullable();
			$table->string('medida1')->nullable();
			$table->dateTime('fecha1')->nullable();
			$table->string('estatus1')->nullable();
			$table->string('peso1')->nullable();
			$table->string('alcanzada1')->nullable();
			$table->string('ponderacion1')->nullable();
			$table->text('comentarios1', 65535)->nullable();
			$table->string('objetivo2')->nullable();
			$table->string('meta2')->nullable();
			$table->string('medida2')->nullable();
			$table->dateTime('fecha2')->nullable();
			$table->string('estatus2')->nullable();
			$table->string('peso2')->nullable();
			$table->string('alcanzada2')->nullable();
			$table->string('ponderacion2')->nullable();
			$table->text('comentarios2', 65535)->nullable();
			$table->string('objetivo3')->nullable();
			$table->string('meta3')->nullable();
			$table->string('medida3')->nullable();
			$table->dateTime('fecha3')->nullable();
			$table->string('estatus3')->nullable();
			$table->string('peso3')->nullable();
			$table->string('alcanzada3')->nullable();
			$table->string('ponderacion3')->nullable();
			$table->text('comentarios3', 65535)->nullable();
			$table->string('objetivo4')->nullable();
			$table->string('meta4')->nullable();
			$table->string('medida4')->nullable();
			$table->dateTime('fecha4')->nullable();
			$table->string('estatus4')->nullable();
			$table->string('peso4')->nullable();
			$table->string('alcanzada4')->nullable();
			$table->string('ponderacion4')->nullable();
			$table->text('comentarios4', 65535)->nullable();
			$table->string('objetivo5')->nullable();
			$table->string('meta5')->nullable();
			$table->string('medida5')->nullable();
			$table->dateTime('fecha5')->nullable();
			$table->string('estatus5')->nullable();
			$table->string('peso5')->nullable();
			$table->string('alcanzada5')->nullable();
			$table->string('ponderacion5')->nullable();
			$table->text('comentarios5', 65535)->nullable();
			$table->string('objetivo6')->nullable();
			$table->string('meta6')->nullable();
			$table->string('medida6')->nullable();
			$table->dateTime('fecha6')->nullable();
			$table->string('estatus6')->nullable();
			$table->string('peso6')->nullable();
			$table->string('alcanzada6')->nullable();
			$table->string('ponderacion6')->nullable();
			$table->text('comentarios6', 65535)->nullable();
			$table->string('objetivo7')->nullable();
			$table->string('meta7')->nullable();
			$table->string('medida7')->nullable();
			$table->dateTime('fecha7')->nullable();
			$table->string('estatus7')->nullable();
			$table->string('peso7')->nullable();
			$table->string('alcanzada7')->nullable();
			$table->string('ponderacion7')->nullable();
			$table->text('comentarios7', 65535)->nullable();
			$table->string('objetivo8')->nullable();
			$table->string('meta8')->nullable();
			$table->string('medida8')->nullable();
			$table->dateTime('fecha8')->nullable();
			$table->string('estatus8')->nullable();
			$table->string('peso8')->nullable();
			$table->string('alcanzada8')->nullable();
			$table->string('ponderacion8')->nullable();
			$table->text('comentarios8', 65535)->nullable();
			$table->string('objetivo9')->nullable();
			$table->string('meta9')->nullable();
			$table->string('medida9')->nullable();
			$table->dateTime('fecha9')->nullable();
			$table->string('estatus9')->nullable();
			$table->string('peso9')->nullable();
			$table->string('alcanzada9')->nullable();
			$table->string('ponderacion9')->nullable();
			$table->text('comentarios9', 65535)->nullable();
			$table->string('objetivo10')->nullable();
			$table->string('meta10')->nullable();
			$table->string('medida10')->nullable();
			$table->dateTime('fecha10')->nullable();
			$table->string('estatus10')->nullable();
			$table->string('peso10')->nullable();
			$table->string('alcanzada10')->nullable();
			$table->string('ponderacion10')->nullable();
			$table->text('comentarios10', 65535)->nullable();
			$table->string('objetivo11')->nullable();
			$table->string('meta11')->nullable();
			$table->string('medida11')->nullable();
			$table->string('fecha11')->nullable();
			$table->string('estatus11')->nullable();
			$table->string('peso11')->nullable();
			$table->string('alcanzada11')->nullable();
			$table->string('ponderacion11')->nullable();
			$table->text('comentarios11', 65535)->nullable();
			$table->text('objetivo12')->nullable();
			$table->text('meta12')->nullable();
			$table->text('medida12')->nullable();
			$table->text('fecha12')->nullable();
			$table->text('estatus12')->nullable();
			$table->text('peso12')->nullable();
			$table->text('alcanzada12')->nullable();
			$table->text('ponderacion12')->nullable();
			$table->text('comentarios12', 65535)->nullable();
			$table->string('objetivo13')->nullable();
			$table->string('meta13')->nullable();
			$table->string('medida13')->nullable();
			$table->dateTime('fecha13')->nullable();
			$table->string('estatus13')->nullable();
			$table->string('peso13')->nullable();
			$table->string('alcanzada13')->nullable();
			$table->string('ponderacion13')->nullable();
			$table->text('comentarios13', 65535)->nullable();
			$table->integer('total1')->nullable();
			$table->integer('total2')->nullable();
			$table->integer('total3')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('desenpenos');
	}

}
