<?php

namespace App\Models;

use App\Models\ParentArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentArticleCategory extends Model
{
    use HasFactory;
    protected $table = 'parent_article_category';
    protected $fillable = [
        'name',
        'tag_line',
        'image',
        'status',
    ];


    public function articles()
    {
        return $this->hasMany(ParentArticle::class,'article_category_id','id');
    }
}
