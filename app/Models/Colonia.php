<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colonia extends Model
{
    use HasFactory;
    protected $connection = 'maderas';
    protected $table="colonia";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkColonia';
    public $timestamps=false;
}
