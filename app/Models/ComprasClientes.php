<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprasClientes extends Model
{
    use HasFactory;
    protected $table="comprascliente";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkcomprasCliente';
    public $timestamps=false;
}
