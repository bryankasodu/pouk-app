<?php

namespace App\Imports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggotaImport implements ToModel, WithHeadingRow  
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    
    public function model(array $row)
    {
        dd($row);

        return new Anggota([

            'keluarga_id'     => $row[2],
            'nama'            => $row[3],
            'hubungan'        => $row[4],
            'gender'          => $row[5],
            'alamat1'         => $row[6],
            'alamat2'         => $row[7],
            'status'          => $row[8],
            'telpon_rumah'    => $row[9],
            'telpon_hp'       => $row[10],
            'pekerjan'        => $row[11],
            'tempat_lahir'    => $row[12],
            'tanggal_lahir'   => $row[13],
            'tempat_baptis'   => $row[14],
            'tanggal_baptis'  => $row[14],
            'tempat_sidi'     => $row[15],
            'tanggal_sidi'    => $row[15],
            'tempat_nikah'    => $row[16],
            'tanggal_nikah'   => $row[17],
            'gereja_asal'     => $row[18],
            'gereja_terdaftar'=> $row[19],
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
}
