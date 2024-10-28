<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QAFollower extends Model
{
    use HasFactory;

    protected $table = 'QA_followers';

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
