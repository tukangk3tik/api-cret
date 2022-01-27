<?php

namespace App\Http\Controllers\Api\Master;

use App\Helpers\StatusUtils;
use App\Http\Controllers\Controller;
use App\Models\MasterTreeFile;
use Illuminate\Http\Request;

class TreeFileController extends Controller
{
    
    public function getTreeFile(Request $request) {
        $type = $request->option;
        $kodeUnit = $request->kode_unit;

         //init log variabel
        $logParams = [
            "id" => $request->id_device,
            "mac_address" => $request->mac,
            "id_pegawai" => $request->id_pegawai,
            "metode" => StatusUtils::DOWNLOAD,
            "menu" => StatusUtils::MASTER
        ];
        
        $tree = MasterTreeFile::select('master_treefile.*');
        if ($type == 'seed') {
            $tree->addSelect(
                'b.id as pokok_id', 
                'b.status as pokok_status', 
                'b.faktorpembagi as pokok_faktorpembagi',
                'b.idunit as pokok_idunit',
                'b.isactive as pokok isactive'
            )
            ->join('seed_sawit as b', 'b.noseleksi', '=', 'master_treefile.noseleksi')
            ->where('master_treefile.kebun', $kodeUnit);

            $logParams["relasi_tabel"] = 'master_tree_seed_production';

        } elseif ($type == 'breed') {
            $tree->addSelect(
                'b.id as pokok_id', 
                'b.tgltambah as pokok_tgltambah', 
                'b.faktorpembagi as pokok_faktorpembagi',
                'b.idunit as pokok_idunit',
                'b.isactive as pokok isactive'
            )
            ->join('breed_pokokbreeding as b', 'b.noseleksi', '=', 'master_treefile.noseleksi')
            ->where('master_treefile.kebun', $kodeUnit);

            $logParams["relasi_tabel"] = 'master_tree_breeding';
        
        } else {
            return $this->failResponse("Tidak ada request");
        }

        //get last sync
        $lastDownloadAt = $this->getLastSync($logParams);

        $tree->where(function($query) use ($lastDownloadAt) {
            $query->where('master_treefile.last_sync', '>', $lastDownloadAt)
                ->orWhere('b.last_sync', '>', $lastDownloadAt);
        });
        
        $treeList = $tree->get();
        
        //store log device
        $this->storeSyncDevice($logParams);

        if ($treeList->count() == 0) return $this->failResponse("Tidak ada data baru");
        
        return $this->successResponse($treeList, "Fetch success");
    }
}
