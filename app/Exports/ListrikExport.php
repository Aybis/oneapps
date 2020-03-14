<?php

namespace App\Exports;

use App\Models\web\main\Listrik;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ListrikExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'no',
            'ID Pelanggan',
            'No Meter',
            'Nama Pelanggan',
            'Alamat Pelanggan',
            'Tarif',
            'Daya',
            'Witel',
            'Kota',
            'Provinsi',
            'Area PINS',
            'DIV RE',
            'Unit UP',
            'Alamat Unit UP',
            'Tipe',
            'Keterangan',
            'Status',
            'NDE',
            'STO',
            'Nama MDU',
            'Koordinat'

        ];
    }
    public function collection()
    {
        return Listrik::all();
    }
}
