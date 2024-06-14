<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoVenta extends Model
{
    use HasFactory;
    protected $table="tipoventa";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkTipoVenta';
    public $timestamps=false;
}
