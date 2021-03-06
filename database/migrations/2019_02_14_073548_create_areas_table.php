<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('ID_Area')->unique();
            $table->string('AreaName',128);
            $table->timestamps();
            $table->unsignedInteger('FK_AreaSede')->nullable();
            $table->unsignedInteger('FK_GenerSede')->nullable();
            $table->foreign('FK_AreaSede')->references('ID_Sede')->on('sedes')->onDelete('cascade');
            $table->foreign('FK_GenerSede')->references('ID_GSede')->on('gener_sedes')->onDelete('cascade');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
