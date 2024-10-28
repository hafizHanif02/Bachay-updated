<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QATag extends Model
{
    use HasFactory;

    protected $table = 'QA_tags';

    protected $fillable = [
        'tag',
        'created_at',
    ];
    public $timestamps = false;

    // Relationships
    public function QA()
    {
        return $this->belongsTo(QA::class);
    }
}
