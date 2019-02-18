<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MantenimientoVehiculo extends Model
{
    protected $table = 'MantenVehics'; 

    protected $filatable = ['MvTecnicoMecanica', 'MvKm', 'MvAceite', 'Mvtanqueo', 'MvtanqueoCant', 'FK_MvProgram', 'FK_ManVehiculo'];

    protected $primarykey = 'ID_Mv';
}