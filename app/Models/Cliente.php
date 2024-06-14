<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table="cliente";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkCliente';
    public $timestamps=false;
}
