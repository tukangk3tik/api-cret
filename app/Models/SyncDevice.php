<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyncDevice extends Model
{
    protected $table = 'sync_device';
    protected $connection = 'sqlsrv';
    public $primaryKey = 'id';

    public $timestamps = true;

}
