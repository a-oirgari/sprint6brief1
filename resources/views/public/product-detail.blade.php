@extends('layouts.public')

@section('title', $product->nom)

@section('content')
<div class="container">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a> / 
        <a href="{{ route('public.categories') }}">Catégories</a> / 
        <a href="{{ route('public.category.products', $product->category->slug) }}">{{ $product->category->nom }}</a> / 
        <strong>{{ $product->nom }}</strong>
    </div>

    <div class="product-detail">
        <div>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom }}" class="product-image">
            @else
                <div style="width: 100%; height: 400px; background: #ecf0f1; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 8rem;">
                    📷
                </div>
            @endif
        </div>

        <div class="product-info">
            <h1>{{ $product->nom }}</h1>
            
            <div style="margin: 1rem 0;">
                <a href="{{ route('public.category.products', $product->category->slug) }}" class="badge">
                    {{ $product->category->nom }}
                </a>
            </div>

            <div class="product-price">{{ $product->formatted_price }}</div>

            <div style="margin: 1.5rem 0;">
                <strong>Référence:</strong> <code>{{ $product->reference }}</code>
            </div>

            <div style="margin: 1.5rem 0;">
                @if($product->isInStock())
                    <span class="card-stock">✓ En stock: {{ $product->stock }} disponible(s)</span>
                @else
                    <span class="card-stock out-of-stock">✗ Rupture de stock</span>
                @endif
            </div>

            @if($product->description_courte)
                <div class="product-description">
                    <h3>Description</h3>
                    <p>{{ $product->description_courte }}</p>
                </div>
            @endif
        </div>
    </div>

    
    @if($relatedProducts->isNotEmpty())
        <h2 class="section-title" style="margin-top: 4rem;">Produits similaires</h2>
        <div class="grid">
            @foreach($relatedProducts as $related)
            <a href="{{ route('public.product.detail', $related->id) }}" class="card">
                @if($related->image)
                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->nom }}" class="card-image">
                @else
                    <div class="card-image" style="display: flex; align-items: center; justify-content: center; font-size: 4rem;">
                        📷
                    </div>
                @endif
                <div class="card-body">
                    <div class="card-title">{{ $related->nom }}</div>
                    <div class="card-price">{{ $related->formatted_price }}</div>
                </div>
            </a>
            @endforeach
        </div>
    @endif
</div>
@endsection