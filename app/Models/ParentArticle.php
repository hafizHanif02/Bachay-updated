<?php

namespace App\Models;

use App\Models\ParentArticleCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentArticle extends Model
{
    use HasFactory;
    protected $fillable = [
        'article_category_id',
        'title',
        'text',
        'thumbnail',
        'status',
    ];
    protected $table = 'parent_articles';

    public function articlecategory()
    {
        return $this->belongsTo(ParentArticleCategory::class,'article_category_id','id');
    }
}
