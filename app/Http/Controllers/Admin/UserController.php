<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Permissions;
use App\Role;
use App\Store;
use App\User;
use App\Userinfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.user');
    }

    public function getusers()
    {
        $users = User::where('id', '<>', 1)->get();
        return $users;
    }


    public function saveuser(Request $request)
    {
        if ($request->editflag != false) {
            $this->validate($request, [
                'username' => 'required',
                'email' => 'required|email',
            ]);
            $save = User::where('id', $request->id)->first();
            if ($request->passwordedit == true) {
                $save->password = bcrypt($request->password);
            }

        } else {
            $this->validate($request, [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);
            $save = new User();
            $save->password = bcrypt($request->password);
        }

        $save->name = $request->username;
        $save->email = $request->email;
        $save->save();
    }

    public function deleteuser(Request $request)
    {
        $keys = array();
        foreach ($request->users as $key => $user) {
            if ($user == true) {
                array_push($keys, $key);
            }
        }
        User::whereIn('id', $keys)->delete();
    }




}
