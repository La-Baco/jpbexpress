<?php

namespace App\Imports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelangganImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     */
    public function model(array $row)
    {
        return new Pelanggan([
            'nama'   => $row['nama'],
            'telpon' => $row['telpon'],
            'alamat' => $row['alamat'],
            'area_id' => $row['area_id'] ?? null,
        ]);
    }
}
