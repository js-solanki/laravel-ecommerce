<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    public function index(Request $request){
       $categories = Category::paginate(5);
       return view('dashboard.category.list')->with('categories', $categories);
    }

   public function add(Request $request){
        return view('dashboard.category.add');
   }

   public function insert(Request $request){
      $data =  $request->all();
      $request->validate([
         'name' => 'required|string|max:255|unique:categories',
         'status' => 'required|numeric'
     ]);
 
     Category::create([
      'name' => $request->input('name'),
      'status' => $request->input('status'),
      ]);
      return redirect()->route('admin-category-list')->with('success', 'Form submitted successfully!');
   }

   public function show($id)
   {
      $category = Category::findOrFail($id);
      return view('dashboard.category.add', compact('category'));
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if ($id) {
         $category = Category::findOrFail($id);
               $request->validate([
                  'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
                  'status' => 'required|numeric'
            ]);
        
            // Update the resource with the request data
            $category->update([
                  'name' => $request->input('name'),
                  'status' => $request->input('status'),
            ]);
            return redirect()->route('admin-category-list')->with('success', 'Category updated successfully');
         } else {
            return view('dashboard.category.add');
         }
    }

   public function destroy($id)
   {
       $category = Category::findOrFail($id);
       $category->delete();
       return redirect()->route('admin-category-list')->with('success', 'Category deleted successfully');
   }
}
