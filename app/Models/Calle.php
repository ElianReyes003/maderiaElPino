<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calle extends Model
{
    use HasFactory;
    protected $table="calle";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkCalle';
    public $timestamps=false;
}
