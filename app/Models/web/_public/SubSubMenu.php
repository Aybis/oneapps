<?php

namespace App\Models\web\_public;

use Illuminate\Database\Eloquent\Model;

class SubSubMenu extends Model
{
    protected $connection = 'mysql';
    protected $table = 'sub_sub_menus';
    protected $fillabel = ['sub_sub_menu_name'];


    function insertSubSubMenu($data)
    {
        $query = SubSubMenu::insert($data);
        return $query;
    }

    function getAllData()
    {
        $query = SubSubMenu::all();
        return $query;
    }

    function updateSubSubMenu($id, $data)
    {
        $query = SubSubMenu::where('id', $id)->update($data);
        return $query;
    }


}
