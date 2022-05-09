<?php

namespace App\Helpers;

use App\Models\SyncDevice;
use App\Models\SyncDeviceLog;

class SyncDeviceHelper {


    /**
     * @param $mac_address
     * @param $table
     * @param $method
     * @param $menu
     * @return string
     */
    public static function getLastSyncDevice($macAddress, $table, $method, $menu): string {
        $device = self::getDevice($macAddress);
        if (!$device) return "";

        $result = SyncDeviceLog::where([
                ['id_device', '=', $device->id],
                ['metode', '=', $method],
                ['relasi_tabel', '=', $table],
                ['menu', '=', $menu]
            ])
            ->orderBy('id', 'desc')
            ->first();

        return $result->sync_at ?? "";
    }

    /**
     * @param $mac_address
     * @return mixed
     */
    public static function getDevice($mac_address) {
        return SyncDevice::where('mac_address', $mac_address)->first();
    }

}
