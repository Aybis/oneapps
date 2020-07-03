<?php

namespace App\Imports;

use App\Models\web\main\NocTicket;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class NocTicketImport implements ToCollection, WithHeadingRow
{

    public function validationFields( $row )
    {

        // $customMessages = [
        //     // 'required' => 'O campo :attribute deve estar preenchido'
        // ];

        Validator::make($row->toArray(), [
            'noticket' => 'unique',
            // 'marca' => 'required',
            // 'status_do_curso' => 'required',
            // 'emissor_cliente' => 'required',
            // 'nome_da_conta' => 'required',
        ])->validate();
   }
    public function collection(Collection $rows)
    {
        $this->validationFields($rows);
        $model = new NocTicket();
        // dd($rows->toArray());
        foreach ($rows as $row)
        {
            // dd(Date::excelToDateTimeObject($row['opentiket'])->format('Y-m-d H:i:s'));
            $model->create([
                'noticket'              => $row['noticket'],
                'customer'              => $row['customer'],
                'layanan'               => $row['layanan'],
                'segment'               => $row['segment'],
                'headline'              => $row['headline'],
                'description'           => $row['description'],
                'area'                  => $row['area'],
                'status'                => $row['status'],
                'statusdate'            => Date::excelToDateTimeObject($row['statusdate'])->format('Y-m-d'),
                'opentiket'             => Date::excelToDateTimeObject($row['opentiket'])->format('Y-m-d H:i:s'),
                'respondtiket'          => Date::excelToDateTimeObject($row['respondtiket'])->format('Y-m-d H:i:s'),
                'durasipending'         => $row['durasipending'],
                'resolvedtiket'         => Date::excelToDateTimeObject($row['resolvedtiket'])->format('Y-m-d H:i:s'),
                'resolveddescription'   => $row['resolveddescription'],
                'closedtiket'           => Date::excelToDateTimeObject($row['closedtiket'])->format('Y-m-d'),
            ]);
        }
    }
}
