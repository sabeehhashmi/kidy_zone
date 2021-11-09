<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Age;

class Ages extends Controller
{
     public function index(Request $request)
    {
        if($request->searchParam != null){
           $allages = Age::paginate(10);
           /*$allcategories = Category::search($request->searchParam)->paginate(10);*/
       }
       else{
        $allages = Age::paginate(10);
       }


       return view('admin.ages',compact('allages'));
   }

    public function age($id='')
    {
        if($id){
          $age =Age::find($id);
        }
        else{
            $age = '';
        }
        return view('admin.addage',compact('age'));
   }
   public function saveAge(Request $request)
    {
        if($request->id){
          $age = Age::find($request->id);
        }
        else{
            $age = new Age();
        }
        $age->name = $request->name;
        $age->slug = $request->slug;
        $age->save();
        return view('admin.addage',compact('age'));
   }
   public function deleteAge($id)
    {

          $age = Age::find($id);

          if($age){
            $age->delete();
          }


        return redirect('/admin/ages');
   }
}
