<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreedPalma extends Model
{
    protected $table = 'breed_palma';
    protected $connection = 'sqlsrv';
    public $primaryKey = 'id';

    public $timestamps = true;

}
