<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::withCount('products')->latest()->get();
        return view('categories.index', compact('categories'));
    }

     
    public function create()
    {
        return view('categories.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'nom.required' => 'Le nom de la catégorie est obligatoire.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        ]);

        $validated['slug'] = Str::slug($validated['nom']);

        Category::create($validated);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Catégorie créée avec succès !');
    }

    
    public function show(Category $category)
    {
        $category->load('products');
        return view('categories.show', compact('category'));
    }

    
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'nom.required' => 'Le nom de la catégorie est obligatoire.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        ]);

        $validated['slug'] = Str::slug($validated['nom']);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Catégorie mise à jour avec succès !');
    }

    
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Catégorie supprimée avec succès !');
    }
}