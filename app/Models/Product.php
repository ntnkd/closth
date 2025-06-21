<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'content',
        'category_id',
        'price',
        'price_sale',
        'active',
        'thumb',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }



}
