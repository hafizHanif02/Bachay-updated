<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodDetail extends Model
{
    protected $fillable = [
        'food_category_id',
        'name',
        'image',
        'nutrients',
        'additional_info',
        'view_count',
    ];

    protected $casts = [
        'additional_info' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'food_category_id');
    }
}
