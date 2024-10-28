<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    use HasFactory;

    protected $table = 'upvote';

    protected $fillable = [
        'userID',
        'QA_id',
        'created_at',
    ];

    public $timestamps = false;
    // Relationships
    public function QA()
    {
        return $this->belongsTo(QA::class, 'QA_id');
    }
}
