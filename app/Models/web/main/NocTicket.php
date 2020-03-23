<?php

namespace App\Models\web\main;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class NocTicket extends Model
{

    protected $connection = 'mysql2';
    protected $table = 'pins_ticket_closed';

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
        // $query = DB::connection('mysql2')->select("SELECT noticket,opentiket, resolvedtiket, TIMESTAMPDIFF(HOUR,opentiket,resolvedtiket) as TIME,durasipending, (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending)as hsil, description   FROM pins_ticket_closed WHERE (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) >24 ");
        $query = DB::connection('mysql2')->select("SELECT count(noticket) as miss, segment FROM pins_ticket_closed WHERE (TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) >4 AND MONTH(opentiket) = ? AND YEAR(opentiket)= ?  GROUP BY segment", [$month, $year]);
        return $query;
    }

    function getDataAll($month, $year)
    {
        if(!$month || !$year){
            $month = date('m');
            $year = date('Y');
        }
        $query = DB::connection('mysql2')->table('pins_ticket_closed')->whereMonth('opentiket',$month)->whereYear('opentiket',$year)->orderBy('opentiket','desc')->get();
        return $query;
    }

    function scopeChart($month, $year)
    {
        if(!$month || !$year){
            $month = date('m');
            $year = date('Y');
        }
        $met = DB::connection('mysql2')
        ->table('pins_ticket_closed')
        ->select(DB::raw('count(noticket) as met'))
        ->whereRaw('(TIMESTAMPDIFF(HOUR,opentiket, resolvedtiket) - durasipending) < 4 AND MONTH(opentiket) = ? AND YEAR(opentiket)= ?', [$month, $year])
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

        $data = DB::connection('mysql2')
        ->table('pins_ticket_closed')
        ->select('area',DB::raw('count(noticket) as total'))
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

}
