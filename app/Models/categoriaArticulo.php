<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoriaArticulo extends Model
{
    use HasFactory;
    protected $table="categoriaarticulo";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkCategoriaArticulo';
    public $timestamps=false;
}
