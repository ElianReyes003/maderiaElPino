<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloTipoVenta extends Model
{
    use HasFactory;
    protected $table="articulotipoventa";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkArticuloTipoVenta';
    public $timestamps=false;
}
