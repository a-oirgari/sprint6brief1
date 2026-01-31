@extends('layouts.public')

@section('title', 'Toutes les Catégories')

@section('content')
<div class="container">
    <h1 class="section-title"> Toutes nos Catégories</h1>

    <div class="grid">
        @foreach($categories as $category)
        <a href="{{ route('public.category.products', $category->slug) }}" class="card">
            <div class="card-image">
                <div style="height: 100%; display: flex; align-items: center; justify-content: center; font-size: 5rem;">
                    📦
                </div>
            </div>
            <div class="card-body">
                <div class="card-title">{{ $category->nom }}</div>
                @if($category->description)
                    <div class="card-text">{{ Str::limit($category->description, 100) }}</div>
                @endif
                <div style="margin-top: 1rem;">
                    <span class="badge">{{ $category->products_count }} produit(s)</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection