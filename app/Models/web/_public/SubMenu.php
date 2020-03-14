<?php

namespace App\Models\web\_public;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $connection = 'mysql';
    protected $table = 'sub_menus';
    protected $fillabel = ['sub_menu_name'];


    function insertSubMenu($data)
    {
        $query = SubMenu::insert($data);
        return $query;
    }

    function getAllData()
    {
        $query = SubMenu::all();
        return $query;
    }

    function updateSubMenu($id, $data)
    {
        $query = SubMenu::where('id', $id)->update($data);
        return $query;
    }


}
