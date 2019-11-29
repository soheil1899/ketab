<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category');
    }

    public function getcategories()
    {
        return Category::where('parent_id',0)->get();
    }

    public function savecategory(Request $request)
    {
        $this->validate($request,[
            'category' => 'required',
        ]);

        if($request->editflag != false){
            $save = Category::where('id', $request->id)->first();
        }else{
            $save = new Category();
            $save->last = 1 ;
            if($request->parentid != 0){
                Category::where('id', $request->parentid)->update(['last' => 0]);
                // Attribute::Where('category_id', $request->parentid)->delete();
            }
        }

        $save->title = $request->category;
        $save->description = $request->description;
        $save->parent_id = $request->parentid;
        $save->save();
    }

    //Delete category
    public function deletecategory(Request $request)
    {
        $keys = array();
        foreach ($request->cats as $key => $cat) {
            if ($cat == true) {
                array_push($keys, $key);
            }
        }
        Category::where('id', $request->parentid)->update(['last' => 1]);
        Category::whereIn('id', $keys)->delete();
    }


    public function getsubcategorys(Request $request)
    {
        return Category::where('parent_id', $request->parentid)->get();
    }




}
