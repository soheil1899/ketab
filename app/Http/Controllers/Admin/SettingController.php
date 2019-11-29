<?php

namespace App\Http\Controllers\Admin;

use App\Filemanager;
use App\Keyword;
use App\Lang;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting');
    }

    public function getsetting(Request $request)
    {
        $setting = Setting::where('id', 1)->first();
        $keyword = explode(' - ', $setting['keywords']);
        $setting['keywords'] = $keyword;

        return $setting;
    }


    public function savesetting(Request $request)
    {
        $setting = $request->setting;
        $save = Setting::where('id', 1)->first();
        if (is_null($save)) {
            $save = new Setting();
        }

        $keywords = implode(' - ', $setting['keywords']);

        $save->mobile = $setting['mobile'];
        $save->keywords = $keywords;
        $save->tellphone = $setting['tellphone'];
        $save->site_title = $setting['site_title'];
        $save->instagram = $setting['instagram'];
        $save->telegram = $setting['telegram'];
        $save->whatsup = $setting['whatsup'];
        $save->twitter = $setting['twitter'];
        $save->fax = $setting['fax'];
        $save->email = $setting['email'];
        $save->address = $setting['address'];
        $save->aboutus = $setting['aboutus'];
        $save->header_description = $setting['header_description'];

        $save->save();


    }


}
