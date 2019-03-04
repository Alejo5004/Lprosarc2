<?php

use Illuminate\Database\Seeder;
use App\SolicitudServicio;

class SolicitudServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = 'Aprobado';
        $Servicio->SolSerTipo = 'interno';
        $Servicio->SolSerAuditable = '1';
        $Servicio->SolSerFrecuencia = '15';
        $Servicio->SolSerConducExter = '';
        $Servicio->SolSerVehicExter = '';
        $Servicio->SolSerSlug = 'user1';
        $Servicio->Fk_SolSerTransportador = '1';
        $Servicio->FK_SolSerGenerSede = '2';
        $Servicio->save();

        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = 'Negada';
        $Servicio->SolSerTipo = 'Externo';
        $Servicio->SolSerAuditable = '1';
        $Servicio->SolSerFrecuencia = '10';
        $Servicio->SolSerConducExter = 'Juan';
        $Servicio->SolSerVehicExter = 'HDT-567';
        $Servicio->SolSerSlug = 'user2';
        $Servicio->Fk_SolSerTransportador = '5';
        $Servicio->FK_SolSerGenerSede = '1';
        $Servicio->save();

        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = 'Pendiente';
        $Servicio->SolSerTipo = 'Alquilado';
        $Servicio->SolSerAuditable = '0';
        $Servicio->SolSerFrecuencia = '5';
        $Servicio->SolSerConducExter = 'Cristian';
        $Servicio->SolSerVehicExter = 'HGT-478';
        $Servicio->SolSerSlug = 'user5';
        $Servicio->Fk_SolSerTransportador = '2';
        $Servicio->FK_SolSerGenerSede = '5';
        $Servicio->save();

        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = 'Incompleta';
        $Servicio->SolSerTipo = 'interno';
        $Servicio->SolSerAuditable = '1';
        $Servicio->SolSerFrecuencia = '45';
        $Servicio->SolSerConducExter = '';
        $Servicio->SolSerVehicExter = '';
        $Servicio->SolSerSlug = 'user4';
        $Servicio->Fk_SolSerTransportador = '4';
        $Servicio->FK_SolSerGenerSede = '3';
        $Servicio->save();

        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = 'Incompleta';
        $Servicio->SolSerTipo = 'interno';
        $Servicio->SolSerAuditable = '0';
        $Servicio->SolSerFrecuencia = '1';
        $Servicio->SolSerConducExter = '';
        $Servicio->SolSerVehicExter = '';
        $Servicio->SolSerSlug = 'user3';
        $Servicio->Fk_SolSerTransportador = '3';
        $Servicio->FK_SolSerGenerSede = '4';
        $Servicio->save();
    }
}