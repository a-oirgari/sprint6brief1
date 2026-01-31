@extends('layouts.app')

@section('title', 'Gestion des Catégories')

@section('content')
<div class="header-actions">
    <h1>Gestion des Catégories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Nouvelle Catégorie</a>
</div>

@if($categories->isEmpty())
    <div class="card">
        <p style="text-align: center; color: #7f8c8d;">Aucune catégorie pour le moment. Créez-en une !</p>
    </div>
@else
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Slug</th>
                <th>Nombre de produits</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><strong>{{ $category->nom }}</strong></td>
                <td><code>{{ $category->slug }}</code></td>
                <td>
                    <span class="badge">{{ $category->products_count }} produit(s)</span>
                </td>
                <td>{{ $category->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ? Tous les produits associés seront également supprimés.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection