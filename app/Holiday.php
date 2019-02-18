<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model{
    protected $table='holidays';
    protected $fillable = ['FestivoDate','FestivoType'];
    protected $primaryKey = 'ID_festivo';
}
