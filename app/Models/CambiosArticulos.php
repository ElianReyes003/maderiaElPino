<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CambiosArticulos extends Model
{
    use HasFactory;
    protected $table="cambiosarticulos";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkCambiosArticulos';
    public $timestamps=false;
}
