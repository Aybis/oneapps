<?php

namespace App\Models\web\main;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class NocTicket extends Model
{

    protected $connection   = 'mysql2';
    protected $table        = 'pins_ticket_closed';
    protected $guarded      = [];
    public $timestamps      = false;

    function scopeMet($month, $year)
    {
        if(!$month || !$year){
            $month = date('m');
            $year = date('Y');
        }
        $query = DB::connection('mysql2')->select("SELECT count(noticket) as met, segment  FROM pins_ticket_closed WHERE (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) < 4 AND MONTH(opentiket) = ? AND YEAR(opentiket)= ?  GROUP BY segment", [$month, $year]);
        return $query;
    }

    function scopeMiss($month, $year)
    {
        if(!$month || !$year){
            $month = date('m');
            $year = date('Y');
        }
        $query = DB::connection('mysql2')->select("SELECT count(noticket) as miss, segment FROM pins_ticket_closed WHERE (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) >4 AND MONTH(opentiket) = ? AND YEAR(opentiket)= ?  GROUP BY segment", [$month, $year]);
        return $query;
    }

    function getDataAll($month, $year)
    {
        if(!$month || !$year){
            $month = date('m');
            $year = date('Y');
        }
        $data = NocTicket::select('*',
                    DB::raw('( CASE
                            WHEN (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) > 4  THEN "MISS"
                            WHEN (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) < 4  THEN "MET"
                            END) AS timeStatus'
                            )
                        )
                ->orderBy('opentiket','desc');
        if($month != 13){
            $data->whereMonth('opentiket', $month)
            ->whereYear('opentiket',$year);
        }
        return $data;
    }

    function scopeChart($month, $year)
    {
        if(!$month || !$year){
            $month = date('m');
            $year = date('Y');
        }
        $met = NocTicket::select(DB::raw('count(noticket) as met'))
        ->whereRaw('
            (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) < 4 AND MONTH(opentiket) = ? AND YEAR(opentiket)= ?',
            [$month, $year]
        )
        ->get();
        $miss = DB::connection('mysql2')
        ->table('pins_ticket_closed')
        ->select(DB::raw('count(noticket) as miss'))
        ->whereRaw('(TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) > 4 AND MONTH(opentiket) = ? AND YEAR(opentiket)= ?', [$month, $year])
        ->get();
        return ['met'=>$met, 'miss'=>$miss];
    }

    function groupByReg($month, $year, $condition)
    {
        if(!$month || !$year){
            $month = date('m');
            $year = date('Y');
        }
        if($condition == 'met'){
            $clause = 'noticket LIKE "%REQ%" AND (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) < 4 ';
        }else if($condition == 'miss'){
            $clause = 'noticket LIKE "%REQ%" AND (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) > 4 ';
        }else if(!$condition){
            $clause = 'noticket LIKE "%REQ%"';
        }

        $data = NocTicket::select('area',DB::raw('count(noticket) as total'))
        ->whereRaw($clause)
        ->whereMonth('opentiket',$month)
        ->whereYear('opentiket',$year)
        ->groupBy('area')
        ->get();
        return $data;
    }

    function groupByRegMiss($month, $year)
    {
        if(!$month || !$year){
            $month = date('m');
            $year = date('Y');
        }
        $data = DB::connection('mysql2')
        ->table('pins_ticket_closed')
        ->select('area',DB::raw('count(noticket) as total'))
        ->whereRaw('(TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) > 4 AND MONTH(opentiket) = ? AND YEAR(opentiket)= ?', [$month, $year])
        ->whereMonth('opentiket',$month)
        ->whereYear('opentiket',$year)
        ->groupBy('area')
        ->get();
        return $data;
    }

    function getDataById($id)
    {
        $query = NocTicket::find($id);
        return $query;
    }

    function insertOrUpdate($noticket, $data)
    {
        $query = NocTicket::updateOrInsert(
            ['noticket' => $noticket],
            $data
        );
        return $query;
    }

    function updateData($id, $data)
    {
        // $query = NocTicket::where('id', $id)->update($data);
        $query = DB::connection('mysql2')->table('pins_ticket_closed')->where('id', $id)->update($data);
        return $query;
    }

    function getSegmentByGroup()
    {
        $query = NocTicket::select('segment')->groupBy('segment')->get();
        return $query;
    }

    function getLayananByGroup()
    {
        $query = NocTicket::select('layanan')->groupBy('layanan')->get();
        return $query;
    }

    function getAreaByGroup()
    {
        $query = NocTicket::select('area')->groupBy('area')->get();
        return $query;
    }

    function getCustomerByGroup()
    {
        $data   = NocTicket::select('customer')->groupBy('customer')->orderBy('customer','asc')->get()->pluck('customer');
        return $data;
    }

    function scopeDataIncident($month, $year, $customer)
    {
        if(!$month || !$year){
            $month  = date('m');
            $year   = date('Y');
        }

        $data   = NocTicket::select('*',
                    DB::raw('( CASE
                            WHEN (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) > 4  THEN "MISS"
                            WHEN (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) < 4  THEN "MET"
                            END) AS timeStatus'
                            )
                        )
                ->where('noticket', 'like', 'IN%')
                ->orderBy('opentiket','desc');

        if($month != 13){
            $data->whereMonth('opentiket', $month)
            ->whereYear('opentiket',$year);
        }

        if($customer != "all"){
            $data->where('customer', $customer);
        }

        return $data;
    }

    function scopeDataRequest($month, $year)
    {
        if(!$month || !$year){
            $month  = date('m');
            $year   = date('Y');
        }

        $data   = NocTicket::select('customer', DB::raw("count('noticket') as total"))
                ->where('noticket', 'like', 'REQ%')
                ->groupBy('customer');
        if($month != 13){
            $data->whereMonth('opentiket', $month)
            ->whereYear('opentiket',$year);
        }
        return $data;
    }

    function scopeDataAll($month, $year)
    {
        if(!$month || !$year){
            $month  = date('m');
            $year   = date('Y');
        }

        $data   = NocTicket::whereMonth('opentiket', $month)
                ->whereYear('opentiket', $year)
                ->orderBy('opentiket','desc');

        return $data;
    }

    function dump()
    {
        $data = NocTicket::select('segment')
                ->groupBy('segment')
                ->get();
        return response()->json($data, 200);
    }


    function importDataExcel($data, $path)
    {
        if(!empty($data) && $data->count()){
            foreach($data as $key => $val){
                $model  = new NocTicket();
                $model->noticket    = $val->noticket;
                $model->customer    = $val->customer;
                dd($model);
            }
        }
    }

}
