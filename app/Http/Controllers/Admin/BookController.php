<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Category;
use App\Nasher;
use App\Writer;
use DemeterChain\B;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;



class BookController extends Controller
{
    public function index()
    {
        return view('admin.book');
    }

    public function getbooks()
    {
        $books = Book::with('category', 'translator', 'writer', 'nasher')->get();
        $category = Category::all();
        $translator = Writer::where('writer_type', 'translate')->get();
        $writer = Writer::where('writer_type', 'writer')->get();
        $nasher = Nasher::all();

        return [$books, $category, $translator, $writer, $nasher];
    }

    public function deletebook(Request $request)
    {
        $keys = array();
        foreach ($request->books as $key => $book) {
            if ($book == true) {
                array_push($keys, $key);
                Storage::disk('media')->deleteDirectory('/filemanager/book/' . $key);
                Storage::disk('media')->delete('/book/' . $key . '.png');
                Storage::disk('media')->delete('/pdfs/pdf_' . $key . '.pdf');
            }
        }
        Book::whereIn('id', $keys)->delete();
    }

    public function savebookimage(Request $request)
    {
        $image = new ImageManager();

        $image->make($request->image->getRealPath())->save(public_path() . '/media/book/' . $request->bookid . '.png');
        Book::where('id', $request->bookid)->update(['image' => '/media/book/' . $request->bookid . '.png']);
    }

    public function savebookdescription(Request $request)
    {
        if (isset($request->bookid)) {
            $save = Book::where('id', $request->bookid)->first();
        } else {
            $save = new Book();
        }
        $save->description = $request->des;
        $save->save();
    }

    public function savebook(Request $request)
    {
        $request->validate([
            'category.id' => 'required',
            'title' => 'required',
        ]);

        if ($request->edit == true) {
            $save = Book::where('id', $request->bookid)->first();
        } else {
            $save = new Book();
        }
        $save->title = $request->title;
        $save->subject = $request->subject;
        $save->category_id = $request->category['id'];
        $save->writer_id = $request->writer['id'];
        $save->translator_id = $request->translator['id'];
        $save->nasher_id = $request->nasher['id'];
        $save->page = $request->page;
        $save->year = $request->year;

        $save->save();
    }

    public function savebookpdf(Request $request)
    {
        $file =$request->file('pdf');
        $file->move(public_path() . '/media/pdfs/','pdf_'.$request->bookid. '.pdf');

        $save = Book::where('id', $request->bookid)->first();
        $save->booklink = '/media/pdfs/pdf_'.$request->bookid. '.pdf';
        $save->save();
    }




}
