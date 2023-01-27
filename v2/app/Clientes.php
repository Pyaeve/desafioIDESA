<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clientes extends Model
{
    // Soft Deleting
    use SoftDeletes;
    // campos que deben poder llenarse
    protected $fillable = ['nombres','apellidos','correo','domicilio'];
}
