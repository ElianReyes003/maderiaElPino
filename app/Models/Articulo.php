<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $table="articulo";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkArticulo';
    public $timestamps=false;
}
