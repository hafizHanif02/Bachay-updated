<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QAAnswerLike extends Model
{
    use HasFactory;

    protected $table = 'QA_answer_like';

    protected $fillable = [
        'userID',
        'QA_ans_id',
        'created_at',
    ];
    public $timestamps = false;

    // Relationships
    public function answer()
    {
        return $this->belongsTo(QAAnswer::class, 'QA_ans_id');
    }
}
