<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeedPolen extends Model
{
    protected $table = 'seed_polen';
    protected $connection = 'sqlsrv';
    public $primaryKey = 'id';

    public $timestamps = true;

}
