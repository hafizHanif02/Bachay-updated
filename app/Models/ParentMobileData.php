<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentMobileData extends Model
{
    use HasFactory;
    protected $table = 'parent_mobile_data';
    protected $fillable = [
        'image', 
        'type', 
        'link',
        'width',
        'margin_bottom',
        'status',
    ];
}
