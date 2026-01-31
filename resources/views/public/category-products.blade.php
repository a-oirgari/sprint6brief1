@extends('layouts.public')

@section('title', $category->nom . ' - Produits')

@section('content')
<div class="container">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a> / 
        <a href="{{ route('public.categories') }}">Catégories</a> / 
        <strong>{{ $category->nom }}</strong>
    </div>

    <h1 class="section-title"> {{ $category->nom }}</h1>

    @if($category->description)
        <p style="text-align: center; color: #7f8c8d; max-width: 600px; margin: 0 auto 3rem;">
            {{ $category->description }}
        </p>
    @endif

    @if($products->isEmpty())
        <div class="card">
            <p style="text-align: center; padding: 3rem; color: #7f8c8d;">
                Aucun produit dans cette catégorie pour le moment.
            </p>
        </div>
    @else
        <div class="grid">
            @foreach($products as $product)
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

        <!-- Pagination -->
        <div class="pagination">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection