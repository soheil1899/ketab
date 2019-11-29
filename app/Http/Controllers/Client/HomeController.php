<?php

namespace App\Http\Controllers\Client;

use App\Book;
use App\Category;
use App\Http\Controllers\Controller;
use App\Likecounter;
use App\Nasher;
use App\Setting;
use App\Slider;
use App\Writer;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Location;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('welcome', compact('setting'));
    }

    public function catbooks($id)
    {
        $setting = Setting::first();
        $flag = $id;
        return view('catsbook', compact('flag', 'setting'));
    }

    public function bookinfo($id)
    {
        $setting = Setting::first();
        $book = Book::where('id', $id)->with('nasher', 'writer', 'translator', 'category')->first();
        return view('bookinfo', compact('book', 'setting'));
    }

    public function personinfo($type, $id)
    {
        $setting = Setting::first();
        if ($type == 'nasher') {
            $person = Nasher::where('id', $id)->first();
        } else {
            $person = Writer::where('id', $id)->first();
        }
        return view('personinfo', compact('person', 'setting'));
    }

    public function moredownload()
    {
        $setting = Setting::first();
        $flag = 'download';
        return view('morepage', compact('flag', 'setting'));
    }

    public function fawerit()
    {
        $setting = Setting::first();
        $flag = 'likes';
        return view('morepage', compact('flag', 'setting'));
    }

    public function contact()
    {
        $setting = Setting::first();
        return view('contact', compact('setting'));
    }

    public function about()
    {
        $setting = Setting::first();
        return view('about', compact('setting'));
    }


    public function getmenu()
    {
        $category = Category::all();
        $nasher = Nasher::all();
        $writer = Writer::where('writer_type', 'writer')->get();
        $translator = Writer::where('writer_type', 'translate')->get();

        return [$category, $nasher, $writer, $translator];
    }

    public function getslider()
    {
        return Slider::all();
    }

    public function getlastbook(Request $request)
    {
        if ($request->flag == 'all') {
            return Book::with('writer', 'translator', 'category')->orderBy('created_at', 'desc')->limit(12)->get();
        } elseif ($request->flag == 'download') {
            return Book::with('writer', 'translator', 'category')->orderBy('download', 'desc')->limit(24)->get();
        } elseif ($request->flag == 'likes') {
            return Book::with('writer', 'translator', 'category')->orderBy('likecounter', 'desc')->limit(24)->get();
        } else {
            $cat = Category::where('id', $request->flag)->first();
            $books = Book::where('category_id', $request->flag)->with('writer', 'translator', 'category')->orderBy('created_at', 'desc')->limit(12)->get();
            return [$cat, $books];
        }
    }

    public function getleftbook(Request $request)
    {
        if ($request->flag == 'download') {
            return Book::with('writer', 'translator', 'category')->orderBy('download', 'desc')->limit(5)->get();
        } else {
            return Book::with('writer', 'translator', 'category')->orderBy('likecounter', 'desc')->limit(5)->get();
        }
    }

    public function search($searchtext)
    {
        $setting = Setting::first();

        $book = Book::where('title', 'like', '%'.$searchtext.'%')->with('writer', 'translator', 'category')->get();
        $nasher = Nasher::where('fullname', 'like', '%'.$searchtext.'%')->get();
        $writer = Writer::where([['fullname', 'like', '%'.$searchtext.'%'],['writer_type', 'writer']])->get();
        $translator = Writer::where([['fullname', 'like', '%'.$searchtext.'%'],['writer_type', 'translate']])->get();

        return view('searchshow', compact('setting','book', 'nasher', 'writer', 'translator', 'searchtext'));
    }

    public function likebook(Request $request)
    {
        $find = Likecounter::where([['user_id', auth()->id()], ['book_id', $request->bookid]])->count();
        if ($find == 0){
            $save = new Likecounter();
            $save->user_id = auth()->id();
            $save->book_id = $request->bookid;
            $save->save();

            Book::where('id', $request->bookid)->increment('likecounter');
        }
    }

    public function downloadbook(Request $request)
    {
        if ($request->link){
            Book::where('id', $request->bookid)->increment('download');

            $arr = explode('/', url()->current());
            return $arr[0].'//'.$arr[2].$request->link;
        }
    }


}
