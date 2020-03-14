<?php

namespace App\Models\web\main;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Listrik extends Model
{

    protected $table = 'listrik';
    protected $fillable = ['id_pelanggan','no_meter','nama_pelanggan','alamat_pelanggan','unitup','alamat_unitup','keterangan'];
    protected $hidden = [
        'created_by',
        'created_at',
        'updated_at',
    ];


     // Get ALl Data
     public function allData(){
        $data = Listrik::orderBy('id_pelanggan', 'desc')->get();
        return $data;
   }

   // Get Witel Grouping
   function scopeWitel(){
       $data = Listrik::select('witel')->groupBy('witel')->get();
       return $data;
   }

   // Get Kota Grouping
   function scopeKota(){
       $data = Listrik::select('kota')->groupBy('kota')->get();
       return $data;
   }

   // Get Provinsi Grouping
   function scopeProvinsi(){
       $data = Listrik::select('provinsi')->groupBy('provinsi')->get();
       return $data;
   }

   // Get Area PINS Grouping
   function scopeAreaPins(){
       $data = Listrik::select('area_pins')->groupBy('area_pins')->get();
       return $data;
   }

   // Get Div RE Grouping
   function scopeDivRe(){
       $data = Listrik::select('divre')->groupBy('divre')->get();
       return $data;
   }

   // Get Unit Up Grouping
   function scopeUnitUp(){
       $data = Listrik::select('unitup')->groupBy('unitup')->get();
       return $data;
   }

   // Get Tipe Prabayar Grouping
   function scopeTipeBayar(){
       $data = Listrik::select('tipe')->groupBy('tipe')->get();
       return $data;
   }

   // Get Tipe Prabayar Grouping
   function scopeNamaPelanggan(){
       $data = Listrik::select('nama_pelanggan')->groupBy('nama_pelanggan')->get();
       return $data;
   }

   // Get Data Sortir Month or Year
   function scopeMonthAndYear($thn, $bln){
       if(!$thn || !$bln){
           $bln = date('m');
           $thn = date('Y');
       }
       $data = Listrik::whereMonth('created_at',$bln)->whereYear('created_at',$thn)->orderBy('created_at','desc')->get();
       return $data;
   }
   function getNamaPelanggan(){
       $data = Listrik::groupBy('nama_pelanggan')->get();
       return $data;
   }

   function getDataPelanggan($pelanggan)
   {
       $data = Listrik::where('id_pelanggan',$pelanggan)->first();
       return $data;
   }

   function insertData($data)
   {
        $query = Listrik::insert($data);
        return $query;
   }

   function updateData($id, $data)
   {
        $query = Listrik::where('id', $id)
        ->update($data);
        return $query;
   }

   function getListrikDataById($id)
   {
       $query = Listrik::where('id_pelanggan',$id)->first();
       return $query;
   }

}
