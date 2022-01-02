<?php

namespace App\Http\Controllers\Api\V1\FieldControl;

use App\Helpers\StatusUtils;
use App\Http\Controllers\Controller;
use App\Repositories\DeviceRepository;
use App\Repositories\FieldControlRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FieldControlController extends Controller
{
    private FieldControlRepository $fieldControlRepository;

    public function __construct(
        FieldControlRepository $fieldControlRepository
    )
    {
        $this->fieldControlRepository = $fieldControlRepository;
    }

    public function uploadQcStaff() 
    {
        return $this->successResponse([], "Berhasil test");
    }

    public function downloadQcStaff(Request $request) 
    {
        //check if device registered
        $device = DeviceRepository::getKodeUnitDevice($request->mac_address);
        if ($device == null) {
            return $this->failResponse(["message" => "Device tidak terdaftar"], "Device tidak terdaftar");
        }

        //init log variabel
        $logParams = [
            "id" => $device->id,
            "mac_address" => $request['mac_address'],
            "relasi_tabel" => 'qc_staff_unions',
            "id_pegawai" => $request['id_pegawai'],
            "metode" => StatusUtils::DOWNLOAD,
            "menu" => StatusUtils::ALL
        ];
        
        //set params for download
        $params['kode_unit'] = $device->kodeunit;
        $params['last_sync'] = "2021-11-30 00:00:00";

        $getLastLog = DeviceRepository::getLastSync($logParams);
        if($getLastLog != null) {
            $params['last_sync'] = $getLastLog->sync_at;
        }
        
        //get download data
        $data = $this->fieldControlRepository->downloadQcStaff($params);

        $finalDt = [];
        foreach ($data as $key => $dt) {
            $dt['last_sync'] = Carbon::parse($dt['last_sync'])->format('Y-m-d H:i:s');
            $dt['created_at'] = Carbon::parse($dt['created_at'])->format('Y-m-d H:i:s');
            $dt['updated_at'] = Carbon::parse($dt['updated_at'])->format('Y-m-d H:i:s');
            $dt['deleted_at'] = ($dt['deleted_at'] != null) ? Carbon::parse($dt['deleted_at'])->format('Y-m-d H:i:s') : $dt['deleted_at'];

            $finalDt[] = $dt;
        }

        //save log
        DeviceRepository::storeSyncDevice($logParams);

        return $this->successResponse($finalDt, "Berhasil ambil data");
    }

}
