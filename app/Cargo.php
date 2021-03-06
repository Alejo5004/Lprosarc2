<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model{
    protected $table = 'cargos';
    protected $fillable = ['CargName','CargSalary','CargGrade','CargDelete','CargArea'];
    protected $primaryKey = 'ID_Carg';

    public function Areas(){
    	return $this->belongsTo('App\Area','ID_Area');
    }
    public function Personal(){
    	return $this->hasMany('App\Personal', 'ID_Pers', 'id');//como cargos tiene mucho personal
    }
}
