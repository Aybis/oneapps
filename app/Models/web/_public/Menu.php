<?php

namespace App\Models\web\_public;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $connection = 'mysql';
    protected $table = 'menus';

    protected $fillable = ['menu_name'];


    function insertMenu($data)
    {
        $query = Menu::insert($data);
        return $query;
    }

    function getAllData()
    {
        $query = Menu::all();
        return $query;
    }

    function updateData($id, $data)
    {
        $query = Menu::where('id', $id)->update($data);
        return $query;
    }
}
