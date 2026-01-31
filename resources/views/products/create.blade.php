@extends('layouts.app')

@section('title', 'Créer un Produit')

@section('content')
<div class="card">
    <div class="card-header">Créer un nouveau produit</div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nom">Nom du produit *</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="reference">Référence *</label>
            <input type="text" name="reference" id="reference" class="form-control" value="{{ old('reference') }}" required>
            @error('reference')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <small style="color: #7f8c8d;">Exemple: PROD-001, TEL-SAMS-A52</small>
        </div>

        <div class="form-group">
            <label for="category_id">Catégorie *</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">-- Sélectionner une catégorie --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
            <textarea name="description_courte" id="description_courte" class="form-control">{{ old('description_courte') }}</textarea>
            @error('description_courte')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label for="prix">Prix (DH) *</label>
                <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix') }}" step="0.01" min="0" required>
                @error('prix')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stock *</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', 0) }}" min="0" required>
                @error('stock')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image">Image du produit</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <small style="color: #7f8c8d;">Formats acceptés: JPG, PNG, GIF (Max: 2MB)</small>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Créer le produit</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Annuler</a>
        </div>
    </form>
</div>
@endsection