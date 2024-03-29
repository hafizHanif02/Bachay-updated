<?php

namespace App\Models;

use App\Models\User;
use App\Models\QnaAnswer;
use App\Models\FamilyRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QnaQuestion extends Model
{
    use HasFactory;
    protected $table = 'qna_question';
    protected $fillable = [
        'question',
        'user_id',
        'child_id',
    ];


    public function answers()
    {
        return $this->hasMany(QnaAnswer::class, 'question_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select(['id', 'name','f_name', 'l_name', 'image']);
    }
    public function child()
    {
        return $this->belongsTo(FamilyRelation::class,'child_id','id');
    }
}
