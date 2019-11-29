<?php

namespace App\Http\Controllers\Admin;

use App\Filemanager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;



class FilemanagerController extends Controller
{
    public function getfilemanager(Request $request)
    {
        if (isset($request->writerid)) {
            return Filemanager::where('writer_id', $request->writerid)->get();
        } else if (isset($request->nasherid)) {
            return Filemanager::where('nasher_id', $request->nasherid)->get();
        } else if (isset($request->bookid)) {
            return Filemanager::where('book_id', $request->bookid)->get();
        }
    }


    public function savefile(Request $request)
    {
        $randomnum = rand(1000, 9999);
        $image = new ImageManager();
        if (isset($request->writerid)){
            $path = 'filemanager/writer/';
            $newfolder = $request->writerid;
        } else if (isset($request->nasherid)){
            $path = 'filemanager/nasher/';
            $newfolder = $request->nasherid;
        } else if (isset($request->bookid)){
            $path = 'filemanager/book/';
            $newfolder = $request->bookid;
        }
        Storage::disk('media')->makeDirectory($path . $newfolder);

        $image->make($request->image->getRealPath())->save(public_path() . '/media/'. $path . $newfolder . '/item_' . $randomnum . '.png');
        $image->make($request->image->getRealPath())->resize('70', '70')->save(public_path() . '/media/'. $path . $newfolder . '/itemsmall_' . $randomnum . '.png');

        $save = new Filemanager();
        $save->image = $randomnum;
        if (isset($request->writerid)){
            $save->writer_id = $request->writerid;
        }else if (isset($request->nasherid)){
            $save->nasher_id = $request->nasherid;
        }else if (isset($request->bookid)){
            $save->book_id = $request->bookid;
        }
        $save->save();

        return $randomnum;
    }
}
