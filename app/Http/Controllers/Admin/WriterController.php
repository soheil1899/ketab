<?php

namespace App\Http\Controllers\Admin;

use App\Writer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Queue\Console\RetryCommand;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;


class WriterController extends Controller
{
    public function writerindex()
    {
        $flag = 1;
        return view('admin.writer', compact('flag'));
    }
    public function translateindex()
    {
        $flag = 2;
        return view('admin.writer', compact('flag'));
    }

    public function getwriters(Request $request)
    {
        return Writer::where('writer_type', $request->writertype)->get();
    }

    public function savewriter(Request $request)
    {
        if ($request->edit == true) {
            $save = Writer::where('id', $request->writerid)->first();
        } else {
            $save = new Writer();
        }
        $save->fullname = $request->name;
        if ($request->writerflag != 'writer') {
            $save->writer_type = 'translate';
        }
        $save->save();
    }

    public function savedescription(Request $request)
    {
        if (isset($request->writerid)) {
            $save = Writer::where('id', $request->writerid)->first();
        } else {
            $save = new Writer();
        }
        $save->description = $request->des;
        $save->save();
    }

    public function deletewriter(Request $request)
    {
        $keys = array();
        foreach ($request->writers as $key => $writer) {
            if ($writer == true) {
                array_push($keys, $key);
                Storage::disk('media')->deleteDirectory('/filemanager/writer/' . $key);
            }
        }
        Writer::whereIn('id', $keys)->delete();
    }


}
