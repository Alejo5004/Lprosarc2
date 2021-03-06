<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audits';

    protected $fillable = ['AuditTabla', 'AuditType', 'AuditRegistro', 'AuditUser', 'Auditlog'];

    protected $casts = [
        'Auditlog' => 'json',
    ];

}
