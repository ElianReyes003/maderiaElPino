<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientosArticulos extends Model
{
    use HasFactory;
    protected $table="movimientosarticulos";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkMovimientosArticulos';
    public $timestamps=false;
}
