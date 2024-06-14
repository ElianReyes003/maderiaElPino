<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaAbono extends Model
{
    use HasFactory;
    protected $table="listaAbono";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkAbonoArticulo';
    public $timestamps=false;
}
