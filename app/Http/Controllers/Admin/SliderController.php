<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Gallery;
use App\Image;
use App\Lang;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.slider');
    }

    public function getslider()
    {
        $slider = Slider::all();

        return $slider;
    }

    public function savesliderimage(Request $request)
    {
        $imagename = rand(10000, 99999);

        $image = new ImageManager();
        $image->make($request->image->getRealPath())->save(public_path() . '/media/slider/original_' . $imagename . '.png');
        $image->make($request->image->getRealPath())->resize('120', '120')->save(public_path() . '/media/slider/small_' . $imagename . '.png');

        $slider = new Slider();
        $slider->image = $imagename;
        $slider->save();

        return [$imagename, $slider->id];

    }


    public function deletesliderimage(Request $request)
    {
        $image = Slider::where('id', $request->id)->first();

        Storage::disk('media')->delete('slider/original_' . $image['image'] . '.png');
        Storage::disk('media')->delete('slider/small_' . $image['image'] . '.png');

        $image->delete();
    }


}
