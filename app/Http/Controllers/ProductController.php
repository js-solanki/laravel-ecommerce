<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Products::with('categories')->paginate(5);
        return view('dashboard.product.list')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('dashboard.product.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
       
        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                $imagePaths[] = $path;
            }
        }
        // Store the image paths as JSON
        $data['images'] = json_encode($imagePaths);
        
        $product = Products::create($data);
       
        // Attach the product to categories
        if ($request->has('category_ids')) {
            $product->categories()->attach($request->input('category_ids'));
        }

        return redirect()->route('admin-product-list')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        $product = Products::findOrFail($id);
        
        // Detach all categories associated with the product
        $product->categories()->detach();
        
        // Delete the product
        $product->delete();

        return redirect()->route('admin-product-list')->with('success', 'Product deleted successfully.');
    }

    public function detail($id){
        $product = Products::with('categories')->findOrFail($id);

        return view('dashboard.product.detail', compact('product'));
    }
}
