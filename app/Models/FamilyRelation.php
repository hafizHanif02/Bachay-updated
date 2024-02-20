<?php

namespace App\Models;

use App\Models\User;
use App\Models\Growth;
use App\Models\VaccinationSubmission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyRelation extends Model
{
    use HasFactory;
    protected $table = 'family_relation';
    protected $fillable = [
        'user_id',
        'relation_type',
        'name',
        'dob',
        'gender',
        'profile_picture',
    ];


    public function parent(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function vaccination_submission(){

        return $this->hasMany(VaccinationSubmission::class,'child_id','id');
    }

    public function growth(){

        return $this->hasMany(Growth::class,'child_id','id');
    }
}
