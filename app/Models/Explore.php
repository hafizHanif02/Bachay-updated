<?php

namespace App\Models;

use App\Models\ExploreItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Explore extends Model
{
    use HasFactory;
    protected $table = 'explore';
    protected $fillable = [
        'title',
        'tags',
        'media',
    ];

    public function items()
    {
        return $this->hasMany(ExploreItem::class);
    }
}
