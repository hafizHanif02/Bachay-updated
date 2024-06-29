<?php

namespace App\Http\Controllers\RestAPI\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Utils\CategoryManager;
use App\Utils\Helpers;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get_categories(Request $request)
    {
        $categories_id = [];
        if($request->has('seller_id') && !empty($request->seller_id)){
            //finding category ids
            $categories_id = Product::active()
                ->when($request->has('seller_id') && !empty($request->seller_id), function ($query) use ($request) {
                    return $query->where(['added_by' => 'seller'])
                        ->where('user_id', $request->seller_id);
                })->pluck('category_id');
        }

        $categories = Category::when($request->has('seller_id') && !empty($request->seller_id), function ($query) use ($categories_id) {
            $query->whereIn('id', $categories_id);
        })
        ->withCount(['product'=>function($query) use($request){
            $query->when($request->has('seller_id') && !empty($request->seller_id), function($query) use($request){
                $query->where(['added_by'=>'seller','user_id'=>$request->seller_id,'status'=>'1']);
            });
        }])->with(['childes' => function ($query) {
            $query->with(['childes' => function ($query) {
                $query->withCount(['subSubCategoryProduct'])->where('position', 2);
            }])->withCount(['subCategoryProduct'])->where('position', 1);
        }, 'childes.childes'])
        ->where('position', 0)->priority()->get();

        return response()->json($categories, 200);

    }

    public function get_sub_categories(Request $request, $category_id)
{
    // Ensure $category_id is an array
    $categoryIds = is_array($category_id) ? $category_id : [$category_id];

    $categories = Category::whereIn('id', $categoryIds)
        ->withCount(['product' => function ($query) use ($request) {
            $query->when($request->has('seller_id') && !empty($request->seller_id), function ($query) use ($request) {
                $query->where(['added_by' => 'seller', 'user_id' => $request->seller_id, 'status' => '1']);
            });
        }])
        ->with(['childes' => function ($query) {
            $query->with(['childes' => function ($query) {
                $query->withCount(['subSubCategoryProduct'])->where('position', 2);
            }])->withCount(['subCategoryProduct'])->where('position', 1);
        }, 'childes.childes'])
        ->where('position', 0)
        ->priority()
        ->get();

        $categories[0]['icon'] = asset('storage/app/public/product/thumbnail/' . $categories[0]['icon']);

    return response()->json($categories, 200);
}

public function get_banners(Request $request, $categories_id){
    $main_banner = Banner::where(['resource_type'=> 'category', 'published'=> 1, 'resource_id'=>$categories_id])->latest()->get();

        foreach($main_banner as $banner){
            $banner->photo = asset('storage/app/public/banner/'.$banner->photo);
            $banner->mobile_photo = asset('storage/app/public/banner/'.$banner->mobile_photo);
        }

        return response()->json([
            'category_banners' => $main_banner
        ]);
}
public function get_products(Request $request, $id)
{
    $products = CategoryManager::products($id, $request);
    $formattedProducts = Helpers::product_data_formatting($products, true);
    
    $filterOptions = [];
    foreach ($products as $product) {
        $choice_options =  $product->choice_options;
        //$choice_options = is_array($choice_options) ? $choice_options : []; // Ensure it's an array
        $filterOptions[] = $choice_options;

    }
    //return $filterOptions;
    $mergedChoices = [];
    foreach ($filterOptions as $choices) {
        foreach ($choices as $choice) {
            
                if (!isset($mergedChoices[$choice->name])) {
                    $mergedChoices[$choice->name] = [
                        'name' => $choice->name,
                        'title' => $choice->title,
                        'options' => []
                    ];
                }
                $mergedChoices[$choice->name]['options'] = array_unique(array_merge($mergedChoices[$choice->name]['options'], array_map('trim', $choice->options)));
            
        }
    }
    
    $allColors = [];
    foreach ($products as $productItem) {
        $colors = is_string($productItem->colors) ? json_decode($productItem->colors, true) : $productItem->colors;
        $colors = is_array($colors) ? $colors : []; // Ensure it's an array
        if ($colors) {
            $allColors = array_merge($allColors, $colors);
        }
    }

    if (!isset($mergedChoices['choice_0'])) {
        $mergedChoices['choice_0'] = ['title' => 'Color', 'options' => []];
    }
    $mergedChoices['choice_0']['options'] = array_unique($allColors);

    foreach ($formattedProducts as $product) {
        // Convert thumbnail path to URL
        $product->thumbnail = asset('storage/app/public/product/thumbnail/' . $product->thumbnail);

        // Convert images path to URL
        $images = $product->images;
        if (is_array($images)) {
            $product->images = array_map(function($image) {
                return asset('storage/app/public/product/' . $image);
            }, $images);
        } else {
            $product->images = [];
        }
        
        // Convert color_image path to URL
        $colorImages = $product->color_image;
        
        if (is_array($colorImages)) {
            
            foreach ($colorImages as $key => $image) {
                //return $image;
                if (is_string($image)) {
                    $colorImages[$key] = asset('storage/app/public/product/' . $image);
                } elseif (is_array($image) && isset($image['color'], $image['image_name'])) {
                    $colorImages[$key]['color'] = '#' . $image['color'];
                    $colorImages[$key]['image_name'] = asset('storage/app/public/product/' . $image['image_name']);
                } else {
                    // Handle unexpected array structure
                    $colorImages[$key] = null;  // or some default value
                }
            }
            $product->color_image = $colorImages;
        } else {
            $product->color_image = [];
        }
    }

    return response()->json(['product' => $formattedProducts, 'filter' => $mergedChoices], 200);
}




    public function find_what_you_need()
    {
        $find_what_you_need_categories = Category::where('parent_id', 0)
            ->with(['childes' => function ($query) {
                $query->withCount(['subCategoryProduct' => function ($query) {
                    return $query->active();
                }]);
            }])
            ->withCount(['product' => function ($query) {
                return $query->active();
            }])
            ->get()->toArray();

        $get_categories = [];
        foreach($find_what_you_need_categories as $category){
            $slice = array_slice($category['childes'], 0, 4);
            $category['childes'] = $slice;
            $get_categories[] = $category;
        }

        $final_category = [];
        foreach ($get_categories as $category) {
            if (count($category['childes']) > 0) {
                $final_category[] = $category;
            }
        }

        return response()->json(['find_what_you_need'=>$final_category], 200);
    }

}
