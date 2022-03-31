<?php 

namespace App\Services;

use App\Helpers\DefaultValue;
use App\Models\SyncDevice;
use App\Models\SyncDeviceLog;
use Carbon\Carbon;

class DeviceService {

    //get device data by mac
    public static function getDevice(String $mac) : SyncDevice {
        $device = SyncDevice::where('mac_address', $mac);
        return $device;
    }

    //get last sync from a device
    public static function getLastSync(Array $data) {
        $lastSync = SyncDeviceLog::where([
                ['id_device', $data['id']],
                ['relasi_tabel', $data['relasi_tabel']],
                ['metode', $data['metode']],
                ['menu', $data['menu']]
            ])
            ->orderBy('id', 'desc')
            ->first();
            
        $lastDate = ($lastSync != null) ? $lastSync->sync_at : DefaultValue::SYNC_DEFAULT_DATE;

        return $lastDate;
    }

    //get device data with unit
    public static function getKodeUnitDevice(String $mac) {
        $device = SyncDevice::select([
            'sync_device.*',
            'b.kodeunit'
        ])
        ->join('unit AS b', 'b.id', '=', 'sync_device.id_unit')
        ->where('sync_device.mac_address', $mac)
        ->get()
        ->first();

        return $device;
    }

    /**
     * RECORD AFTER SYNC
     * @param Array
     */
    public static function storeSyncDevice(Array $data) {
        $log = new SyncDeviceLog();

        $log->id_device = $data['id'];
        $log->sync_at = Carbon::now();
        $log->relasi_tabel = $data['relasi_tabel'];
        $log->id_pegawai = $data['id_pegawai'];
        $log->metode = $data['metode'];
        $log->menu = $data['menu'];

        $log->save();
    }
    

}