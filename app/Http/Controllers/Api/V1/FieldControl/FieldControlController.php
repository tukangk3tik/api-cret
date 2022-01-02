<?php

namespace App\Http\Controllers\Api\V1\FieldControl;

use App\Helpers\DefaultValue;
use App\Helpers\StatusUtils;
use App\Http\Controllers\Controller;
use App\Models\QcStaffUnion;
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

    public function uploadQcStaff(Request $request) 
    {
        $device = DeviceRepository::getKodeUnitDevice($request->mac_address);
        if ($device == null) {
            return $this->failResponse("Device tidak terdaftar");
        }

        $countData = count($request->data);

        //check if no data of list
        if ($countData == 0) {
            return $this->failResponse("Tidak ada data yang akan diupload");
        }

        //init log variabel
        $logParams = [
            "id" => $device->id,
            "id_pegawai" => $request->id_pegawai,
            "mac_address" => $request['mac_address'],
            "relasi_tabel" => 'qc_staff_unions',
            "metode" => StatusUtils::DOWNLOAD,
            "menu" => StatusUtils::ALL
        ];

        //get last download
        $download = DeviceRepository::getLastSync($logParams);
        $lastDownloadAt = ($download != null) ? $download->sync_at : DefaultValue::SYNC_DEFAULT_DATE;

        //set metode to upload and get latest upload
        $logParams['metode'] = StatusUtils::UPLOAD;
        $upload = DeviceRepository::getLastSync($logParams);
        $lastUploadAt = ($upload != null) ? $upload->sync_at : DefaultValue::SYNC_DEFAULT_DATE;

        //return message to download before upload
        if ($lastUploadAt >= $lastDownloadAt) {
            return $this->failResponse("Harap download lebih dahulu");
        }

        //insert all uploaded data
        $insertData = $this->fieldControlRepository->insertQcStaff($request->data);

        if ($insertData['count'] == 0) {
            return $this->failResponse("Seluruh QC Staff data gagal diupload");
        }
        
        //check if count data bigger than count inserted
        if ($countData > $insertData['count']) {
            return $this->failResponse("Beberapa data QC Staff gagal diupload");
        }

        //save log
        DeviceRepository::storeSyncDevice($logParams);

        return $this->successResponse($insertData['data'], "Data berhasil diupload");
    }

    public function downloadQcStaff(Request $request) 
    {
        //check if device registered
        $device = DeviceRepository::getKodeUnitDevice($request->mac_address);
        if ($device == null) {
            return $this->failResponse("Device tidak terdaftar");
        }

        //init log variabel
        $logParams = [
            "id" => $device->id,
            "mac_address" => $request->mac_address,
            "relasi_tabel" => 'qc_staff_unions',
            "id_pegawai" => $request->id_pegawai,
            "metode" => StatusUtils::DOWNLOAD,
            "menu" => StatusUtils::ALL
        ];
        
        //set params for download
        $params['kode_unit'] = $device->kodeunit;
        $params['last_sync'] = DefaultValue::SYNC_DEFAULT_DATE;

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

        if (count($finalDt) == 0) {
            return $this->failResponse("Tidak ada data baru");
        }

        return $this->successResponse($finalDt, "Berhasil ambil data");
    }

}
