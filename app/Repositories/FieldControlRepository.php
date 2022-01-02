<?php 

namespace App\Repositories;

use App\Models\QcStaffUnion;
use Carbon\Carbon;

class FieldControlRepository {

    //get latest data from qc staff
    public function downloadQcStaff(Array $params) {

        $data = QcStaffUnion::where("kode_unit", $params['kode_unit'])
            ->where('last_sync', '>', $params['last_sync'])
            ->get()
            ->toArray();

        return $data;
    }


    public function insertQcStaff(Array $data): Array {

        $insertedId = [];
        foreach ($data as $key => $value) {

            $check = QcStaffUnion::where([
                    ['table_production', '=', $value['table_production']],
                    ['id_production', '=', $value['id_production']],
                    ['jenis_qc', '=', $value['jenis_qc']],
                    ['table_qc', '=', $value['table_qc']],
                    ['id_qc', '=', $value['id_qc']]
                ])
                ->get();

            //skip when already inserted
            if ($check->isNotEmpty()) {
                continue;
            }
            
            $qc = new QcStaffUnion();

            $qc->id_treefile = $value['id_treefile'];
            $qc->table_production = $value['table_production'];
            $qc->id_production = $value['id_production'];
            $qc->jenis_qc = $value['jenis_qc'];
            $qc->table_qc = $value['table_qc'];
            $qc->id_qc = $value['id_qc'];
            $qc->kode_pekerja = $value['kode_pekerja'];
            $qc->kode_mandor = $value['kode_mandor'];
            $qc->label_sungkup = $value['label_sungkup'];
            $qc->label_mantri_sungkup = $value['label_mantri_sungkup'];
            $qc->label_polen = $value['label_polen'];
            $qc->label_mantri_kawinan = $value['label_mantri_kawinan'];
            $qc->jlh_janjang = $value['jlh_janjang'];
            $qc->keterangan = $value['keterangan'];
            $qc->tgl_input = $value['tgl_input'];
            $qc->kode_staff = $value['kode_staff'];
            $qc->kode_unit = $value['kode_unit'];
            $qc->last_sync = Carbon::now();

            $result = $qc->save();

            //collect id for return successful inserted
            if ($result) {
                $insertedId[] = $value['id'] . "-" . $qc->id;
            }
        }

        $result = [
            "count" => count($insertedId),
            "data" => $insertedId
        ];

        return $result;
    }

}