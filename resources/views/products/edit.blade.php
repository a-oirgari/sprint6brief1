@extends('layouts.app')

@section('title', 'Modifier le Produit')

@section('content')
<div class="card">
    <div class="card-header">Modifier le produit : {{ $product->nom }}</div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom du produit *</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $product->nom) }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="reference">Référence *</label>
            <input type="text" name="reference" id="reference" class="form-control" value="{{ old('reference', $product->reference) }}" required>
            @error('reference')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Catégorie *</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">-- Sélectionner une catégorie --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->nom }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description_courte">Description courte</label>
            <textarea name="description_courte" id="description_courte" class="form-control">{{ old('description_courte', $product->description_courte) }}</textarea>
            @error('description_courte')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label for="prix">Prix (DH) *</label>
                <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix', $product->prix) }}" step="0.01" min="0" required>
                @error('prix')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stock *</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0" required>
                @error('stock')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image">Image du produit</label>
            @if($product->image)
                <div style="margin-bottom: 1rem;">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom }}" style="max-width: 200px; border-radius: 8px;">
                    <p style="color: #7f8c8d; margin-top: 0.5rem;">Image actuelle</p>
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <small style="color: #7f8c8d;">Laisser vide pour conserver l'image actuelle. Formats acceptés: JPG, PNG, GIF (Max: 2MB)</small>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Annuler</a>
        </div>
    </form>
</div>
@endsection