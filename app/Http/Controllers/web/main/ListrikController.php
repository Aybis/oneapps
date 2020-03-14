<?php

namespace App\Http\Controllers\web\main;

use App\Models\web\main\Listrik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Exports\ListrikExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;


class ListrikController extends \App\Http\Controllers\Controller
{
    // Declare  Variable
    protected $model;
    protected $kota;
    protected $witel;
    protected $provinsi;
    protected $area;
    protected $divre;
    protected $tipe;
    protected $unitup;

    public function __construct()
    {
        // Declare Model
        $this->model = new Listrik();

        // Declare function scope for grouping data
        $this->kota = $this->model->scopeKota();
        $this->witel = $this->model->scopeWitel();
        $this->provinsi = $this->model->scopeProvinsi();
        $this->area = $this->model->scopeAreaPins();
        $this->divre = $this->model->scopeDivRe();
        $this->tipe = $this->model->scopeTipeBayar();
        $this->unitup = $this->model->scopeUnitUp();

    }

    public function detailDataPelanggan($param)
    {
        $data = $this->model->getDataPelanggan($param);
        return response()->json($data);
    }

    public function ajaxData()
    {

        // Get All Data
        $data = $this->model->allData();
        return DataTables()->of($data)
        ->addColumn('modal_edit', function($data){
            $modal_edit =array(
                "id" => $data->id,
                "id_pelanggan" => $data->id_pelanggan,
            );
            return  $modal_edit;
        })
        ->addIndexColumn()
        ->make(true);
    }

    public function form()
    {

        return view('modules.web.main.listrik.form', array(
            'kota' => $this->kota,
            'witel' => $this->witel,
            'provinsi' => $this->provinsi,
            'area' => $this->area,
            'divre' => $this->divre,
            'tipe' => $this->tipe,
            'unitup' => $this->unitup));
    }

    public function edit($id)
    {
        return view('modules.web.main.listrik.edit',
        array(
            'listrik' => $this->model->getDataPelanggan($id),
            'kota' => $this->kota,
            'witel' => $this->witel,
            'provinsi' => $this->provinsi,
            'area' => $this->area,
            'divre' => $this->divre,
            'tipe' => $this->tipe,
            'unitup' => $this->unitup));
    }

    public function listrik()
    {
        return view('modules.web.main.listrik.list_data');
    }

    public function store(Request $request)
    {

        // Create Array for Insert
        $data = [];
        $data = $request->except('_token','id_listrik');
        $id = $request->input('id_listrik');
        // Process Query
        DB::beginTransaction();
        try{
            if(!$id){
                $validator =Validator::make($request->all(),[
                    'id_pelanggan' => 'required|unique:listrik',
                    ])->validate();

                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = Auth::user()->id;
                $insert = $this->model->insertData($data);
                DB::commit();
                return redirect('/listrik')->with('success','Listrik has been successfully added');

            }else{
                $data['updated_at'] = date('Y-m-d H:i:s');
                $insert = $this->model->updateData($id,$data);
                DB::commit();
                return redirect('/listrik')->with('success','Listrik has been successfully update');
            }
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->back()
            ->withErrors("Something wrong with your form , please check carefully")
            ->withInput();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
            ->withErrors("Something wrong from the server, please check carefully")
            ->withInput();
        }
    }

    public function destroy()
    {

    }

    public function export(Request $request)
    {
        return Excel::download(new ListrikExport, 'listrik.xlsx');
    }
}
