<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeedPalma extends Model
{
    protected $table = 'seed_palma';
    protected $connection = 'sqlsrv';
    public $primaryKey = 'id';

    public $timestamps = true;

}
