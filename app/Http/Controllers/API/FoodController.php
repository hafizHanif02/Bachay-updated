<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use App\Models\FoodDetail;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    // Get all food categories
    public function getFoodCategories()
    {
        $categories = FoodCategory::all(['id', 'name']);
        return response()->json(['categories' => $categories], 200);
    }

    // Get food details by category ID
    public function getFoodDetails($categoryId)
    {
        $foodDetails = FoodDetail::where('food_category_id', $categoryId)
                                  ->get(['id', 'name', 'nutrients', 'image', 'additional_info']);
        
        return response()->json(['foods' => $foodDetails], 200);
    }

    // Get details of a specific food item
    public function getFoodItemDetail($foodId)
    {
        $foodItem = FoodDetail::find($foodId, ['id', 'name', 'nutrients', 'image', 'additional_info']);
        
        if ($foodItem) {
            return response()->json(['food' => $foodItem], 200);
        } else {
            return response()->json(['error' => 'Food item not found'], 404);
        }
    }

    public function getAllFoodItemDetail(){
        $foodDetails = FoodDetail::orderBy('id', 'desc')
        ->get(['id', 'name', 'nutrients', 'image', 'additional_info']);

        return response()->json(['foods' => $foodDetails], 200);
    }
}
