<?php

namespace App\Models;

use App\Models\Growth;
use App\Models\VaccinationSubmission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vaccination extends Model
{
    use HasFactory;
    protected $table = 'vaccination';
    protected $fillable = [
        'name',
        'age',
        'disease',
        'protest_against',
        'to_be_give',
        'how',
    ];


    public function vaccination_submissions()
    {
        return $this->hasMany(VaccinationSubmission::class);
    }

    public function grwoth(){
        return $this->belongsTo(Growth::class,'id','vaccination_id');
    }
}
