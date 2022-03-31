<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterTreeFile extends Model
{
    use SoftDeletes;
    
    protected $table = 'master_treefile';
    protected $connection = 'sqlsrv';
    public $primaryKey = 'id';

}
