<?php

namespace App\Http\Controllers\web\main;

use App\Models\web\main\NocTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class NocController extends \App\Http\Controllers\Controller
{
    // Declare Variable
    protected $model;
    protected $segment;
    protected $area;
    protected $layanan;

    public function __construct()
    {
        // Declare Model
        $this->model = new NocTicket();
        $this->segment = $this->model->getSegmentByGroup();
        $this->layanan = $this->model->getLayananByGroup();
        $this->area = $this->model->getAreaByGroup();

    }

    public function formTicket()
    {
        return view('modules.web.main.noc.form',
        array(
            'segment'=>$this->segment,
            'area'=>$this->area,
            'layanan'=>$this->layanan)
        );
    }

    public function editTicket($id)
    {
        return view('modules.web.main.noc.edit',
        array(
            'data'=>$this->model->getDataById($id),
            'segment'=>$this->segment,
            'area'=>$this->area,
            'layanan'=>$this->layanan)
        );
    }

    public function dataMet(){
       $data = $this->model->scopeMet(3,2020);
       return response()->json($data);
    }

    public function dataMiss(){
        $data = $this->model->scopeMiss(3,2020);
        return response()->json($data);
    }

    public function dashboard()
    {
        return view('modules.web.main.noc.dashboard');
    }

    public function dataAll(Request $request)
    {
        $data = $this->model->getDataAll(
            $request->input('month'),
            $request->input('year'));
            return DataTables()->of($data)
            ->addColumn('edit', function($data){
                $edit =array(
                    "id" => $data->id,
                    "noticket" => $data->noticket,
                );
                return  $edit;
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function dataMissMet(Request $request)
    {
        $data = $this
                ->model
                ->scopeChart(
                    $request->input('month'),
                    $request->input('year')
                );
        return response()->json($data);
    }

    public function dataGropingByReg(Request $request)
    {
            $data = $this
            ->model
            ->groupByReg(
                $request->input('month'),
                $request->input('year'),
                $request->input('condition'),
            );
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'noticket' => 'required|unique:mysql2.pins_ticket_closed',
            'customer' => 'required',
            'layanan' => 'required',
            'segment' => 'required',
            'resolveddescription' => 'required'
        ])->validate();


        // Declare Variable
        $data = [];
        $data = $request->except('_token','durasipending');
        $data['durasipending'] = str_replace(':','.',$request->durasipending);
        $query = $this->model->insertOrUpdate($request->noticket, $data);

        return redirect('/noc/dashboard')->with('message','Data has been insert successfully');

    }

    public function update(Request $request,$id)
    {
        $data = [];
        $data = $request->except('_token','durasipending');
        // $data['durasipending'] = str_replace(':','.',$request->durasipending);
        $query = $this->model->updateData($id, $data);
        return redirect('/noc/dashboard')->with('message','Data has been insert successfully');

    }
}
