<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    protected $table = 'food_categories'; // Use your existing table name

    protected $fillable = ['name', 'description']; // Match these with your database table columns

    // Relationship with food details
    public function foods()
    {
        return $this->hasMany(FoodDetail::class, 'food_category_id');
    }
}
