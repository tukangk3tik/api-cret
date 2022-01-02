<?php 

namespace App\Repositories;

use App\Models\QcStaffUnion;

class FieldControlRepository {

    //get latest data from qc staff
    public function downloadQcStaff(Array $params) {

        $data = QcStaffUnion::where("kode_unit", $params['kode_unit'])
            ->where('last_sync', '>', $params['last_sync'])
            ->get()
            ->toArray();

        return $data;
    }

}