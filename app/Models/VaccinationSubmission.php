<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vaccination;
use App\Models\FamilyRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VaccinationSubmission extends Model
{
    use HasFactory;
    protected $table = 'vaccination_submission';
    protected $fillable = [
        'user_id',
        'child_id',
        'vaccination_id',
        'vaccination_date',
        'submission_date',
        'picture',
        'is_taken',
    ];

    public function vaccination()
    {
        return $this->belongsTo(Vaccination::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function child()
    {
        return $this->belongsTo(FamilyRelation::class);
    }
}
