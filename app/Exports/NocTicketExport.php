<?php

namespace App\Exports;

use App\Models\web\main\NocTicket;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NocTicketExport implements FromQuery, WithHeadings
{

    use Exportable;

    public function __construct(int $month, int $year, $customer="all")
    {
            $this->month    = $month;
            $this->year     = $year;
            $this->customer = $customer;
    }

    public function headings(): array
    {
        return [
            'id',
            'noticket',
            'customer',
            'layanan',
            'segment',
            'headline',
            'description',
            'area',
            'status',
            'statusdate',
            'opentiket',
            'respondtiket',
            'durasipending',
            'resolvedtiket',
            'resolveddescription',
            'closedtiket'
        ];
    }

    public function query()
    {
        // dd($this->month, $this->year, $this->customer);
        // get Data
        $data = NocTicket::orderBy('opentiket','desc');

        // conditon if select all
        if($this->month != 13){
            $data->whereMonth('opentiket', $this->month)
                ->whereYear('opentiket',$this->year);
        }

        // condition group is selected
        if($this->customer != "all"){
            $data->where('customer',$this->customer);
        }

        return $data;
    }
}
