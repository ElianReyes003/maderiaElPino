<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use HasFactory;
    protected $table="documentos";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkDocumentos';
    public $timestamps=false;
}
