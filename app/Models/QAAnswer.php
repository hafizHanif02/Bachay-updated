<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QAAnswer extends Model
{
    use HasFactory;

    protected $table = 'QA_answer';

    protected $fillable = [
        'userID',
        'QA_id',
        'QA_answer',
        'isExpert',
        'created_at',
    ];
    public $timestamps = false;

    // Relationships
    public function QA()
    {
        return $this->belongsTo(QA::class, 'QA_id');
    }

    public function likes()
    {
        return $this->hasMany(QAAnswerLike::class, 'QA_ans_id');
    }

    public function likesCount()
    {
        return $this->hasMany(QAAnswerLike::class, 'QA_answer_id')->count();
    }

}
