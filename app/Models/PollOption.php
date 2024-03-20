<?php

namespace App\Models;

use App\Models\Poll;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PollOption extends Model
{
    use HasFactory;
    protected $table = 'poll_option';
    protected $fillable = [
        'poll_id',
        'option',
    ];

    public function poll(){
        return $this->belongsTo(Poll::class, 'poll_id');
    }
}
