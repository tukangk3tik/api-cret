<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyncDeviceLog extends Model
{
    protected $table = 'sync_device_log';
    protected $connection = 'sqlsrv';
    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['id_device'];
}
