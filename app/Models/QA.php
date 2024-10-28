<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models;

class QA extends Model
{
    use HasFactory;

    protected $table = 'QA';

    protected $fillable = [
        'user_id',
        'childID',
        'question',
        'image',
        'is_anonymous',
        'created_at',
        'updated_at'
    ];

    // Relationships
    public function followers()
    {
        return $this->hasMany(QAFollower::class, 'QA_id');
    }

    public function upvotes()
    {
        return $this->hasMany(Upvote::class, 'QA_id');
    }

    public function downvotes()
    {
        return $this->hasMany(Downvote::class, 'QA_id');
    }

    // Count relationships
    public function followersCount()
    {
        return $this->hasMany(QAFollower::class, 'QA_id')->count();
    }

    public function upvotesCount()
    {
        return $this->hasMany(Upvote::class, 'QA_id')->count();
    }

    public function downvotesCount()
    {
        return $this->hasMany(Downvote::class, 'QA_id')->count();
    }

    public function answers()
    {
        return $this->hasMany(QAAnswer::class, 'QA_id')->with('likes');
    }

    // New relationship to the User model
    // Relationship to the User model
    public function userDetails()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')
                    ->select('id', 'f_name', 'l_name', 'image');
    }


    // Relationship to the FamilyRelation (child) model
    public function child()
    {
        return $this->belongsTo(FamilyRelation::class, 'childID', 'id');
    }
}
