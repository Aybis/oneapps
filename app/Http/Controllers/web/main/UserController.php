<?php

namespace App\Http\Controllers\web\main;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        return view('modules.web.main.user.index');
    }

    public function form()
    {
        return view('modules.web.main.user.form');
    }

    public function store(Request $request)
    {
        Validator::extend('without_space', function($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required|max:200',
            'username' => 'required|unique:users|min:3|without_space',
            'email' => 'required|unique:users',
        ],['without_space' => "Username can't contain any space."]);

        $model = new User();
        // Define Variable
        $id = $request->input('id');
        $username = $request->input('username');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = 'gloryHorsePower';
        // $password = 'ijustmadeiteasyforyou';

        // Create Array to Post
        $query = [];
        $query['name'] = $name;
        $query['username'] = $username;
        $query['email'] = $email;
        if ($password)
            $query['password'] = Hash::make($password);

        // Define Value for Session Flash
        $session_post = 'Error';
        $session_message = 'Something wrong database server :( please try again.';
        dd($query);

        // Process Query
        if (!$id) {
            // Insert
            $_post = $model->insertUser($query);
            if ($_post) {
                $session_post = 'Success';
                $session_message = 'Data was successfully created!.';
            }
        } else {
            // Update
            $query['id'] = $id;
            $query['updated_at'] = date('Y-m-d H:i:s');
            $query = $model->updateUser($query);
            if ($_post) {
                $session_post = 'Success';
                $session_message = 'Data was successfully updated!.';
            }
        }
        // Set Session Flash
        Session::flash('post', $session_post);
        Session::flash('message', $session_message);

    }


}
