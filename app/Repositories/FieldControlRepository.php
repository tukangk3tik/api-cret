<?php 

namespace App\Repositories;

use App\Models\BreedPalma;
use App\Models\BreedPolen;
use App\Models\QcStaffUnion;
use App\Models\SeedPalma;
use App\Models\SeedPolen;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
                    ['id_qc', '=', $value['id_qc']]
                ])
                ->get();

            //skip when already inserted
            if ($check->isNotEmpty()) {
                continue;
            }
            
            $qc = new QcStaffUnion();

            $tableQcStaff = self::setTableQcStaff($value['table_production'], $value['jenis_qc']);

            $qc->id_treefile = $value['id_treefile'];
            $qc->table_production = $value['table_production'];
            $qc->id_production = $value['id_production'];
            $qc->jenis_qc = $value['jenis_qc'];
            $qc->table_qc = $tableQcStaff;
            $qc->id_qc = $value['id_qc'];
            $qc->kode_pekerja = self::setPekerjaQcStaff($value['table_production'], $value['id_production']);
            $qc->kode_mandor = $value['kode_mandor']; //self::setMandorQcStaff($tableQcStaff, $value['id_qc']);
            $qc->label_sungkup = isset($value['label_sungkup']) ? $value['label_sungkup'] : null;
            $qc->label_mantri_sungkup = isset($value['label_mantri_sungkup']) ? $value['label_mantri_sungkup'] : null;
            $qc->label_polen = isset($value['label_polen']) ? $value['label_polen'] : null;
            $qc->label_mantri_kawinan = isset($value['label_mantri_kawinan']) ? $value['label_polen'] : null;
            $qc->jlh_janjang = isset($value['jlh_janjang']) ? $value['jlh_janjang'] : null;
            $qc->keterangan = isset($value['keterangan']) ? $value['keterangan'] : null;
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

    //generate table qc for qc staff
    public static function setTableQcStaff(String $table, int $qc): String 
    {
        $qcStr = "";
        $tableQc = "";

        switch ($qc) {
            case 1: 
                $qcStr = "qcsatu";
                break;
            case 1: 
                $qcStr = "qcdua";
                break;
            case 1: 
                $qcStr = "qctiga";
                break;
            case 1: 
                $qcStr = "qcempat";
                break;
        }

        switch($table) {
            case 'seed_palma':
                $tableQc = "seed_" . $qcStr;
                break;

            case 'seed_polen':
                $tableQc = "seed_polen" . $qcStr;
                break;

            case 'breed_palma':
                $tableQc = "breed_" . $qcStr;
                break;

            case 'breed_polen':
                $tableQc = "breed_polen" . $qcStr;
                break;
        }

        return $tableQc;
    }


    /**
     * get kode  pekerja for qcstaff
     */
    public static function setPekerjaQcStaff(String $table, int $idProduksi): String 
    {
        $data = "";

        switch($table) {
            case 'seed_palma':

                $getStaff = SeedPalma::select([
                        'b.kode'
                    ])
                    ->leftJoin('master_pegawai AS b', 'b.kode', '=', 'seed_palma.penyungkup')
                    ->where('seed_palma.id', $idProduksi)
                    ->get()
                    ->first();
                
                $data = $getStaff->kode;

                break;

            case 'seed_polen':
                
                $getStaff = SeedPolen::select([
                        'b.kode'
                    ])
                    ->leftJoin('master_pegawai AS b', 'b.kode', '=', 'seed_polen.kodepekerja')
                    ->where('seed_polen.id', $idProduksi)
                    ->get()
                    ->first();
                
                $data = $getStaff->kode;

                break;

            case 'breed_palma':
                
                $getStaff = BreedPalma::select([
                        'b.kode'
                    ])
                    ->leftJoin('master_pegawai AS b', 'b.kode', '=', 'breed_palma.penyungkup')
                    ->where('breed_palma.id', $idProduksi)
                    ->get()
                    ->first();
                
                $data = $getStaff->kode;

                break;

            case 'breed_polen':
                
                $getStaff = BreedPolen::select([
                        'b.kode'
                    ])
                    ->leftJoin('master_pegawai AS b', 'b.kode', '=', 'breed_polenpanen.kdpenyerbuk')
                    ->where('breed_polenpanen.id', $idProduksi)
                    ->get()
                    ->first();
                
                $data = $getStaff->kode;

                break;
        }

        return $data;
    }

    /**
     * get kode / id  mandor for qcstaff
     */
    // public static function setMandorQcStaff(String $table, int $idQc): String 
    // {
    //     $kode = "";

    //     $kodeExist = Schema::connection('sqlsrv')
    //         ->hasColumn($table, 'kodemandor');

    //     $idExist = Schema::connection('sqlsrv')
    //         ->hasColumn($table, 'kodemandor');

    //     if ($kodeExist) {
    //         $data = DB::table($table . ' AS a')
    //             ->select('b.nama as mandor')
    //             ->leftJoin('b.master_pegawai', 'b.id', '=', 'a.kodemandor')
    //             ->where('a.id', $idQc)
    //             ->get();

    //         $kode = $data->kodemandor;

    //     } elseif ($idExist) {
    //         $data = DB::table($table . ' AS a')
    //             ->select('b.nama as mandor')
    //             ->leftJoin('b.master_pegawai', 'b.id', '=', 'a.idmandor')
    //             ->where('a.id', $idQc)
    //             ->get();

    //         $kode = $data->idmandor;
    //     }

    //     return $kode;
    // }
    
}