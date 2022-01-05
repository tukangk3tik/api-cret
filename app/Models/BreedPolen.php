<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreedPolen extends Model
{
    protected $table = 'breed_polenpanen';
    protected $connection = 'sqlsrv';
    public $primaryKey = 'id';

    public $timestamps = true;

}
