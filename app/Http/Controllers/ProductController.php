<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'reference' => 'required|string|unique:products,reference|max:255',
            'description_courte' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nom.required' => 'Le nom du produit est obligatoire.',
            'reference.required' => 'La référence est obligatoire.',
            'reference.unique' => 'Cette référence existe déjà.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.min' => 'Le prix doit être positif.',
            'stock.required' => 'Le stock est obligatoire.',
            'stock.min' => 'Le stock doit être positif ou zéro.',
            'category_id.required' => 'Veuillez sélectionner une catégorie.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format: jpeg, png, jpg ou gif.',
            'image.max' => 'L\'image ne doit pas dépasser 2MB.',
        ]);

        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produit créé avec succès !');
    }

    
    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'reference' => 'required|string|max:255|unique:products,reference,' . $product->id,
            'description_courte' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nom.required' => 'Le nom du produit est obligatoire.',
            'reference.required' => 'La référence est obligatoire.',
            'reference.unique' => 'Cette référence existe déjà.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.min' => 'Le prix doit être positif.',
            'stock.required' => 'Le stock est obligatoire.',
            'stock.min' => 'Le stock doit être positif ou zéro.',
            'category_id.required' => 'Veuillez sélectionner une catégorie.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format: jpeg, png, jpg ou gif.',
            'image.max' => 'L\'image ne doit pas dépasser 2MB.',
        ]);

        
        if ($request->hasFile('image')) {
            
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produit mis à jour avec succès !');
    }

    
    public function destroy(Product $product)
    {
        
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Produit supprimé avec succès !');
    }
}