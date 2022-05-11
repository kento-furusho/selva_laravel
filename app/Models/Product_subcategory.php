<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_subcategory extends Model
{
    protected $fillable = [
        'product_category_id',
        'name'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
