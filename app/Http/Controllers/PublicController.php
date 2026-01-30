<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    
    public function home()
    {
        $categories = Category::withCount('products')->take(6)->get();
        $productsRecents = Product::with('category')->latest()->take(8)->get();
        
        return view('public.home', compact('categories', 'productsRecents'));
    }

    
    public function categories()
    {
        $categories = Category::withCount('products')->get();
        
        return view('public.categories', compact('categories'));
    }

    
    public function categoryProducts($slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();
        $products = Product::ofCategory($category->id)->paginate(12);
        
        return view('public.category-products', compact('category', 'products'));
    }

    
    public function productDetail($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $relatedProducts = Product::ofCategory($product->category_id)
                                  ->where('id', '!=', $id)
                                  ->take(4)
                                  ->get();
        
        return view('public.product-detail', compact('product', 'relatedProducts'));
    }
}