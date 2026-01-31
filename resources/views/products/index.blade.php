@extends('layouts.app')

@section('title', 'Gestion des Produits')

@section('content')
<div class="header-actions">
    <h1>Gestion des Produits</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Nouveau Produit</a>
</div>

@if($products->isEmpty())
    <div class="card">
        <p style="text-align: center; color: #7f8c8d;">Aucun produit pour le moment. Créez-en un !</p>
    </div>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Référence</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                    @else
                        <div style="width: 60px; height: 60px; background: #ecf0f1; border-radius: 4px; display: flex; align-items: center; justify-content: center;">📷</div>
                    @endif
                </td>
                <td><strong>{{ $product->nom }}</strong></td>
                <td><code>{{ $product->reference }}</code></td>
                <td>
                    <span class="badge">{{ $product->category->nom }}</span>
                </td>
                <td><strong style="color: #27ae60;">{{ $product->formatted_price }}</strong></td>
                <td>
                    @if($product->isInStock())
                        <span style="color: #27ae60;">✓ {{ $product->stock }}</span>
                    @else
                        <span style="color: #e74c3c;">✗ Rupture</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline;" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
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