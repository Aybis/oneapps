<?php

namespace App\Http\Controllers\web\_public;

use App\Models\web\_public\Menu;
use App\Models\web\_public\SubMenu;
use App\Models\web\_public\SubSubMenu;
use Illuminate\Http\Request;
// use Illuminate\Validation\Validator;
use \Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;


class MenuController extends \App\Http\Controllers\Controller
{

    public function index()
    {
        $model_menu = new Menu();
        $model_sub_menu = new SubMenu() ;
        $model_sub_sub_menu = new SubSubMenu();
        $query_menu = $model_menu->getAllData();
        $query_sub_menu = $model_sub_menu->getAllData();
        $query_sub_sub_menu = $model_sub_sub_menu->getAllData();

        return response()->json(['query_menu, query_sub_menu,query_sub_sub_menu']);
    }

    public function storeMenu(Request $request)
    {
        // Make validation Form
        $validator = Validator::make($request->all(),[
            'menu_name' => 'required|unique:menus',
            'menu_display' => 'required|unique:menus',
        ])->validate();

        // Declare Variable and insert to array
        $data = $request->except('_token');
        // Declare Model
        $model = new Menu();
        // Insert Data

        DB::beginTransaction();
        try{
            $data['created_at'] = date('Y-m-d H:i:s');
            $insert = $model->insertMenu($data);
            DB::commit();
            return redirect()->route('menu.data')->with('success','Menu has been successfully added');

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
}
