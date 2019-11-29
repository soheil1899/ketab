<?php

namespace App\Http\Controllers\Admin;

use App\Nasher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;


class NasherController extends Controller
{
    public function index()
    {
        return view('admin.nasher');
    }

    public function getnashers()
    {
        return Nasher::all();
    }

    public function deletenasher(Request $request)
    {
        $keys = array();
        foreach ($request->nashers as $key => $nasher) {
            if ($nasher == true) {
                array_push($keys, $key);
                Storage::disk('media')->deleteDirectory('/filemanager/nasher/' . $key);
            }
        }
        Nasher::whereIn('id', $keys)->delete();
    }

    public function savenasher(Request $request)
    {
        if ($request->edit == true) {
            $save = Nasher::where('id', $request->nasherid)->first();
        } else {
            $save = new Nasher();
        }
        $save->fullname = $request->title;
        $save->save();
    }

    public function savenasherdes(Request $request)
    {
        if (isset($request->nasherid)) {
            $save = Nasher::where('id', $request->nasherid)->first();
        } else {
            $save = new Nasher();
        }
        $save->description = $request->des;
        $save->save();
    }









}
