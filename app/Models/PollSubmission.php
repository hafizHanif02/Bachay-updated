<?php

namespace App\Models;

use App\Models\Poll;
use App\Models\User;
use App\Models\PollOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PollSubmission extends Model
{
    use HasFactory;
    protected $table = 'poll_submission';
    protected $fillable = [
        'poll_id',
        'option_id',
        'user_id',
    ];

    public function poll(){
        return $this->belongsTo(Poll::class, 'poll_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function option(){
        return $this->belongsTo(PollOption::class, 'option_id');
    }

}
