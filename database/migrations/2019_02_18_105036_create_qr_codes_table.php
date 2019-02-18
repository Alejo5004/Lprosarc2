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
            $table->timestamps();
            $table->integer('QrCodeEstiba'); /*numero de estiba de cada residuo(para los casos donde hay varias estibas por residuo)*/
            $table->string('QrCodeSrc',255); /*direccion donde esta guardado el codigo qr para su reimpresion*/
            $table->unsignedInteger('FK_QrCodeRespel');/*foranea para ingresar informacion en el codigo QR(cantidad pesada)*/
            $table->foreign('FK_QrCodeRespel')->references('ID_ResEnv')->on('res_envios'); 
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