<?php

namespace App\Http\Controllers\web\main;

use App\Exports\NocTicketExport;
use App\Imports\NocTicketImport;
use App\Models\web\main\NocTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;

class NocController extends \App\Http\Controllers\Controller
{
    // Declare Variable
    protected $model;
    protected $segment;
    protected $area;
    protected $layanan;
    protected $customer;

    public function __construct()
    {
        // Declare Model
        $this->model    = new NocTicket();

        $this->area     = $this->model->getAreaByGroup();
        $this->customer = $this->model->getCustomerByGroup();
        $this->layanan  = $this->model->getLayananByGroup();
        $this->segment  = $this->model->getSegmentByGroup();

    }

    public function formTicket()
    {
        return view('modules.web.main.noc.form',
        array(
            'segment'   => $this->segment,
            'area'      => $this->area,
            'layanan'   => $this->layanan)
        );
    }

    public function editTicket($id)
    {
        return view('modules.web.main.noc.edit',
        array(
            'data'      => $this->model->getDataById($id),
            'segment'   => $this->segment,
            'area'      => $this->area,
            'layanan'   => $this->layanan)
        );
    }

    public function dashboard()
    {
        return view('modules.web.main.noc.dashboard',
            array(
                'customer'  => $this->customer
            ));
    }

    public function getDataAll(Request $request)
    {
        $data = $this->model->getDataAll($request->input('month'), $request->input('year'));
            return DataTables()->of($data)
                ->addColumn('edit', function($data){
                    $edit = array(
                        "id" => $data->id,
                        "noticket" => $data->noticket,
                    );
                    return  $edit;
                })
                ->addIndexColumn()
                ->make(true);
    }

    public function dataGropingByReg(Request $request)
    {
            $data = $this->model
                    ->groupByReg(
                        $request->input('month'),
                        $request->input('year'),
                        $request->input('condition'),
                    );
        return response()->json($data);
    }

    public function getDataIncident(Request $request)
    {
        $data   = $this->model->scopeDataIncident($request->month, $request->year, $request->customer)->get();
        return response()->json($data, 200);
    }

    public function getDataRequest(Request $request)
    {
        $data   = $this->model->scopeDataRequest($request->month, $request->year)->get();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'noticket'              => 'required|unique:mysql2.pins_ticket_closed',
            'customer'              => 'required',
            'layanan'               => 'required',
            'segment'               => 'required',
            'resolveddescription'   => 'required'
        ])
        ->validate();


        // Declare Variable
        $data                   = [];
        $data                   = $request->except('_token','durasipending');
        $data['durasipending']  = str_replace(':','.',$request->durasipending);
        $query                  = $this->model->insertOrUpdate($request->noticket, $data);

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

    public function importDataExcel(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'file'              => 'required|mimes:xls',
        ])
        ->validate();

        if($request->hasFile('file')){
            $data   = Excel::import(new NocTicketImport, $request->file('file'));
            // $data = (new NocTicketImport)->import($path, null, \Maatwebsite\Excel\Excel::XLS);
        }
        return redirect()->back()->with(['success' => 'Upload Berhasil']);
    }

    public function exportDataExcel(Request $request)
    {
        return (new NocTicketExport($request->bulan, $request->tahun, $request->customer))->download('Ticketing '.date('L, F-Y').'.xls');
    }

    public function getDataDump()
    {
        $data = $this->model->dump();
        return $data;
    }
}
