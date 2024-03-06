<?php

namespace App\Models;

use App\Models\NavCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NavCategorySub extends Model
{
    use HasFactory;
    protected $table = 'nav_category_sub';
    protected $fillable = [
        'title',
        'url',
        'nav_category_id',
    ];


    public function nav_category()
    {
        return $this->belongsTo(NavCategory::class, 'nav_category_id', 'id');
    }
}
