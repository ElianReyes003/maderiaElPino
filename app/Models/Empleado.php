<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table="empleado";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkEmpleado';
    public $timestamps=false;
}
