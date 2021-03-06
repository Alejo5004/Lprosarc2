<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQrCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*falta relacionar la tabla de envrespsel*/
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->increments('ID_QrCode');
            $table->integer('QrCodeEstiba'); /*numero de estiba de cada residuo(para los casos donde hay varias estibas por residuo)*/
            $table->string('QrCodeSrc',255); /*direccion donde esta guardado el codigo qr para su reimpresion*/
            $table->timestamps();
            $table->unsignedInteger('FK_QrCodeSolSer')->nullable();/*foranea para ingresar informacion en el codigo QR(cantidad pesada)*/
            $table->foreign('FK_QrCodeSolSer')->references('ID_SolSer')->on('solicitud_servicios')->onDelete('cascade');
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
        Schema::dropIfExists('qr_codes');
    }
}
