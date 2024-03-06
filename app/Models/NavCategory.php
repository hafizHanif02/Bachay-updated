<?php

namespace App\Models;

use App\Models\Category;
use App\Models\NavCategorySub;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NavCategory extends Model
{
    use HasFactory;
    protected $table = 'nav_category';
    protected $fillable = [
        'title',
        'image',
        'url',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function nav_subs()
    {
        return $this->hasMany(NavCategorySub::class, 'nav_category_id', 'id');
    }
}
