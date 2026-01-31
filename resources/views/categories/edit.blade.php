@extends('layouts.app')

@section('title', 'Modifier la Catégorie')

@section('content')
<div class="card">
    <div class="card-header">Modifier la catégorie : {{ $category->nom }}</div>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom de la catégorie *</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $category->nom) }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Annuler</a>
        </div>
    </form>
</div>
@endsection