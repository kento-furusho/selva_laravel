<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function product_subcategory()
    {
        return $this->hasMany(Product_subcategory::class);
    }
    // $categories = Product_category::when(isset($id), function($q)use($id) {
    //     return $q->where('id', $id);
    // })->when(isset($free_word), function($q)use($free_word){
    //     $q->where(function($q)use($free_word){
    //         $pat = '%' . addcslashes($free_word, '%_\\') . '%';
    //         $q->where('name', 'LIKE', $pat)
    //         ->orWhere(function($q)use($free_word){
    //             $pat = '%' . addcslashes($free_word, '%_\\') . '%';
    //             $q->whereHas('Product_subcategory',function($q)use($pat) {
    //                 $q->where('name', 'LIKE', $pat);
    //             });
    //         });
    //     });
    // })->orderBy('id', 'desc')->paginate(10);
    public function scopeSearch($query, $id, $free_word)
    {
            // ddd($man);
            $query->when(isset($id), function($q)use($id) {
                return $q->where('id', $id);
            });
            $query->when(isset($free_word), function($q)use($free_word){
                return $q->where(function($q)use($free_word){
                    $pat = '%' . addcslashes($free_word, '%_\\') . '%';
                    $q->where('name', 'LIKE', $pat)
                    ->orWhere(function($q)use($free_word){
                        $pat = '%' . addcslashes($free_word, '%_\\') . '%';
                        $q->whereHas('Product_subcategory',function($q)use($pat) {
                            $q->where('name', 'LIKE', $pat);
                        });
                    });
                });
            });
    }
}
