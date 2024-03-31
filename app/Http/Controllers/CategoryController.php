<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    public function index(Request $request){
       $categories = Category::all();
       return view('dashboard.category.list')->with('categories', $categories);
    }

   public function add(Request $request){
        return view('dashboard.category.add');
   }

   public function insert(Request $request){
      $data =  $request->all();
      $request->validate([
         'name' => 'required',
         'status' => 'required|numeric'
         // Add more validation rules for other form fields
     ]);
 
     Category::create([
      'name' => $request->input('name'),
      'status' => $request->input('status'),
      // Add more fields as needed
      ]);
      return redirect()->route('admin-category-list')->with('success', 'Form submitted successfully!');
   }
}
