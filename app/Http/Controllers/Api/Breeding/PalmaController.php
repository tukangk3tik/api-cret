<?php

namespace App\Http\Controllers\Api\Breeding;

use App\Helpers\SyncDeviceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PalmaController extends Controller
{

    public function getPalmaData(Request $request) {
        $macAddress = $request->mac_address;
        $lastSync = SyncDeviceHelper::getLastSyncDevice($macAddress, "breed_palma", "GET", "all");

        if ($lastSync == "") $lastSync = "2020-11-19 00:00:00";
    }

}
