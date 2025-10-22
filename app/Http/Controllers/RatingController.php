<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    //

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Rating::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $product->id],
            ['rating' => $request->input('rating'), 'comment' => $request->input('comment')]
        );

        return redirect()->back()->with('success', 'Your rating has been submitted!');
    }

    public function index(Product $product)
    {
        $ratings = $product->ratings()->with('user')->latest()->get();
        return view('ratings.index', compact('product', 'ratings'));
    }
    
}
