<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class Categories extends Controller
{
    public function index(Request $request)
    {
        if($request->searchParam != null){
           $allcategories = Category::paginate(10);
           /*$allcategories = Category::search($request->searchParam)->paginate(10);*/
       }
       else{
        $allcategories = Category::paginate(10);
       }


       return view('admin.categories',compact('allcategories'));
   }

    public function category($id='')
    {
        if($id){
          $category = Category::find($id);
        }
        else{
            $category = '';
        }
        return view('admin.addcategory',compact('category'));
   }
   public function saveCategory(Request $request)
    {
        if($request->id){
          $category = Category::find($request->id);
        }
        else{
            $category = new Category();
        }
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        return view('admin.addcategory',compact('category'));
   }
   public function deleteCategory($id)
    {

          $category = Category::find($id);

          if($category){
            $category->delete();
          }


        return redirect('/admin/categories');
   }
}
