<?php

namespace App\Http\Controllers\Api\V1\FieldControl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FieldControlController extends Controller
{

    public function uploadQcStaff() 
    {
        return $this->successResponse([], "Berhasil test");
    }

    public function downloadQcStaff() 
    {
        return $this->successResponse([], "Berhasil test");
    }

}
