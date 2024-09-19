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
                                ->get(['id', 'name', 'nutrients', 'image', 'additional_info', 'view_count']);
        
        foreach ($foodDetails as $food) {
            // Update the image path to include the full asset URL
            $food->image = asset($food->image);

            // Check if additional_info is a string and decode it only if needed
            if (is_string($food->additional_info)) {
                $additionalInfo = json_decode($food->additional_info, true);
            } else {
                $additionalInfo = $food->additional_info;
            }

            // Iterate over the additional info to update the icon paths
            foreach ($additionalInfo as $key => $value) {
                $additionalInfo[$key]['icon'] = asset($value['icon']);
            }

            // Re-assign the modified additional_info back to the food item
            $food->additional_info = $additionalInfo;
        }
        
        return response()->json(['foods' => $foodDetails], 200);
    }


    // Get details of a specific food item
    public function getFoodItemDetail($foodId)
    {
        $foodItem = FoodDetail::find($foodId, ['id', 'name', 'nutrients', 'image', 'additional_info', 'view_count']);
        
       
            $foodItem->image = asset($foodItem->image);

            // Check if additional_info is a string and decode it only if needed
            if (is_string($foodItem->additional_info)) {
                $additionalInfo = json_decode($foodItem->additional_info, true);
            } else {
                $additionalInfo = $foodItem->additional_info;
            }

            // Iterate over the additional info to update the icon paths
            foreach ($additionalInfo as $key => $value) {
                $additionalInfo[$key]['icon'] = asset($value['icon']);
            }

            // Re-assign the modified additional_info back to the food item
            $foodItem->additional_info = $additionalInfo;

            FoodDetail::where('id', $foodId)->increment('view_count', 1);

        if ($foodItem) {
            return response()->json(['food' => $foodItem], 200);
        } else {
            return response()->json(['error' => 'Food item not found'], 404);
        }
    }

    public function getAllFoodItemDetail(){
        $foodDetails = FoodDetail::orderBy('id', 'desc')
        ->get(['id', 'name', 'nutrients', 'image', 'additional_info', 'view_count']);

        foreach ($foodDetails as $food) {
            // Update the image path to include the full asset URL
            $food->image = asset($food->image);

            // Check if additional_info is a string and decode it only if needed
            if (is_string($food->additional_info)) {
                $additionalInfo = json_decode($food->additional_info, true);
            } else {
                $additionalInfo = $food->additional_info;
            }

            // Iterate over the additional info to update the icon paths
            foreach ($additionalInfo as $key => $value) {
                $additionalInfo[$key]['icon'] = asset($value['icon']);
            }

            // Re-assign the modified additional_info back to the food item
            $food->additional_info = $additionalInfo;
        }

        return response()->json(['foods' => $foodDetails], 200);
    }
}
