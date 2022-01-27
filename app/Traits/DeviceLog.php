<?php 

namespace App\Traits;

use App\Helpers\DefaultValue;
use App\Models\SyncDevice;
use App\Models\SyncDeviceLog;
use App\Services\DeviceService;
use Carbon\Carbon;

trait DeviceLog {
    /**
     * Traits for device log function
     */

    public static function getDevice(String $mac) : SyncDevice {
        return DeviceService::getDevice($mac);
    }

    public static function getLastSync(Array $data) {
        return DeviceService::getLastSync($data);
    }

    public static function getKodeUnitDevice(String $mac) {
       return DeviceService::getKodeUnitDevice($mac);
    }

    public static function storeSyncDevice(Array $data) {
       DeviceService::storeSyncDevice($data);
    }
}