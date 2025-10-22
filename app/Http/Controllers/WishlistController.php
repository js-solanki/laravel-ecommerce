<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('wishlist.index', compact('wishlistItems'));
    }

    public function add(Products $product)
    {
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    public function remove(Wishlist $wishlist)
    {
        if ($wishlist->user_id == Auth::id()) {
            $wishlist->delete();
            return redirect()->back()->with('success', 'Product removed from wishlist!');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }
}
