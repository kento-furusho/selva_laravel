<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'member_id',
        'product_id',
        'evaluation',
        'comment'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function scopeSearch($query, $id, $free_word)
    {
            $query->when(isset($id), function($q)use($id) {
                return $q->where('id', $id);
            });
            $query->when(isset($free_word), function($q)use($free_word){
                $pat = '%' . addcslashes($free_word, '%_\\') . '%';
                return $q->where('comment', 'LIKE', $pat);
            });
    }
}
