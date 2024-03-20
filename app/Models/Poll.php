<?php

namespace App\Models;

use App\Models\PollOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poll extends Model
{
    use HasFactory;
    protected $table = 'poll';
    protected $fillable = [
        'question',
        'start_date',
        'end_date',
        'status',
    ];

    public function poll_option(){
        return $this->hasMany(PollOption::class, 'poll_id');
    }
}
