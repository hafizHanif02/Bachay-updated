<?php

namespace App\Models;

use App\Models\Explore;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExploreItem extends Model
{
    use HasFactory;
    protected $table = 'explore_item';
    protected $fillable = [
        'explore_id',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function explore()
    {
        return $this->belongsTo(Explore::class);
    }
}
