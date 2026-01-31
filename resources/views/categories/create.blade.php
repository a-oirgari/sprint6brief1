@extends('layouts.app')

@section('title', 'Créer une Catégorie')

@section('content')
<div class="card">
    <div class="card-header">Créer une nouvelle catégorie</div>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nom">Nom de la catégorie *</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <small style="color: #7f8c8d;">Le slug sera généré automatiquement à partir du nom</small>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Créer la catégorie</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Annuler</a>
        </div>
    </form>
</div>
@endsection