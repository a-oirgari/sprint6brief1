@extends('layouts.public')

@section('title', 'TifawinSouk - Accueil')

@section('content')
<div class="hero">
    <h1> Bienvenue sur TifawinSouk</h1>
    <p>Votre marketplace locale pour des produits de qualité</p>
</div>

<div class="container">
    <!-- Catégories -->
    <h2 class="section-title"> Nos Catégories</h2>
    <div class="grid">
        @foreach($categories as $category)
        <a href="{{ route('public.category.products', $category->slug) }}" class="card">
            <div class="card-image">
                <div style="height: 100%; display: flex; align-items: center; justify-content: center; font-size: 4rem;">
                    📦
                </div>
            </div>
            <div class="card-body">
                <div class="card-title">{{ $category->nom }}</div>
                <div class="card-text">{{ $category->products_count }} produit(s)</div>
            </div>
        </a>
        @endforeach
    </div>

    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('public.categories') }}" class="btn btn-primary">Voir toutes les catégories</a>
    </div>

    
    <h2 class="section-title" style="margin-top: 4rem;"> Produits récents</h2>
    <div class="grid">
        @foreach($productsRecents as $product)
        <a href="{{ route('public.product.detail', $product->id) }}" class="card">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom }}" class="card-image">
            @else
                <div class="card-image" style="display: flex; align-items: center; justify-content: center; font-size: 4rem;">
                    📷
                </div>
            @endif
            <div class="card-body">
                <div class="card-title">{{ $product->nom }}</div>
                <div class="card-text">{{ Str::limit($product->description_courte, 60) }}</div>
                <div class="card-price">{{ $product->formatted_price }}</div>
                @if($product->isInStock())
                    <span class="card-stock">En stock: {{ $product->stock }}</span>
                @else
                    <span class="card-stock out-of-stock">Rupture de stock</span>
                @endif
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection