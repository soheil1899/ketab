<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Permissions;
use App\Permission;
use App\Role;
use App\User;
use App\Userinfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    public function index()
    {
        return view('admin.dashboard');
    }



    public function getmyinfo()
    {
        return view('admin.myinfo');
    }

    public function getmyinfos(Request $request)
    {
        return auth()->user();
    }


    public function savemyinfo(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'oldpass' => 'required|min:8',
            'newpass' => 'required|min:8',
            'repass' => 'required|min:8',
        ]);
        if (Hash::check($request->oldpass, auth()->user()->password)) {
            if ($request->newpass == $request->repass) {
                $save = User::where('id', auth()->user()->id)->first();

                $save->name = $request->name;
                $save->email = $request->email;
                $save->password = bcrypt($request->newpass);

                $save->save();

                $action = 'true';
                return $action;
            } else {
                return 'foo';
            }
        } else {
            return 'bar';
        }


    }


    public function superadmininfo()
    {
        $id = 1;
        return view('admin.userinfo', compact('id'));
    }







}
