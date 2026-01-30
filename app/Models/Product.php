<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'reference',
        'description_courte',
        'prix',
        'stock',
        'image',
        'category_id'
    ];

    protected $casts = [
        'prix' => 'decimal:2',  
        'stock' => 'integer',   
    ];

    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        
        return asset('images/no-product.png');
    }

    
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    
    public function scopeOfCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

   
    public function isInStock()
    {
        return $this->stock > 0;
    }

    
    public function getFormattedPriceAttribute()
    {
        return number_format($this->prix, 2, ',', ' ') . ' DH';
    }
}