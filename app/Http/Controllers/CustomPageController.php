<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\FlashDeal;
use App\Models\CustomPage;
use App\Models\CustomPageData;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CustomPageController extends Controller
{
    public function AllCustomePage(){
        $custom_pages = CustomPage::with('page_data')->get();

        foreach ($custom_pages as $custom_page) {
            $resource_model = $custom_page->resource_type;
            switch ($resource_model) {
                case 'category':
                    $model = Category::class;
                    break;
                case 'sub_category':
                    $model = Category::class;
                    break;
                case 'brand':
                    $model = Brand::class;
                    break;
                case 'product':
                    $model = Product::class;
                    break;
                case 'banner':
                    $model = Banner::class;
                    break;
                case 'deals':
                    $model = FlashDeal::class;
                    break;
                case 'shop':
                        $model = Shop::class;
                        break;
                default:
                    $model = null; // Handle the default case if necessary
            }

            if ($model) {
                $custom_page->resource_name = $model::where('id', $custom_page->resource_id)->first();
            }
        }
        //return $custom_pages;


        return view('admin-views.custom-page.custom_page', compact('custom_pages'));
    }

    public function CustomePageStore(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
            'resource_type' => 'required',
        ]);
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/custom_page/'), $filename);
        }
        CustomPage::create([
            'title' => $request->title,
            'image' => $filename,
            'resource_type' => $request->resource_type,
            'resource_id' => $request[$request->resource_type . '_id'],
        ]);
        Toastr::success('Custom Page Has Been Created');
            return redirect()->route('admin.custom-page.list');

    }

    public function CustomePageWeb(Request $request, $id){
        $CustomPage = CustomPage::findOrFail($id);
        $CustomPage->is_web = $CustomPage->is_web ? 0 : 1;
        $CustomPage->save();
        return response()->json(['success' => true, 'is_web' => $CustomPage->is_web]);
    }

    public function CustomePageMobile(Request $request, $id){
        $CustomPage = CustomPage::findOrFail($id);
        $CustomPage->is_mobile = $CustomPage->is_mobile ? 0 : 1;
        $CustomPage->save();
        return response()->json(['success' => true, 'is_mobile' => $CustomPage->is_mobile]);
    }

    public function EditCustomPage($id){
        $custom_page = CustomPage::where('id', $id)->with('page_data')->first();
        switch ($custom_page->resource_type) {
            case 'category':
                $model = Category::class;
                break;
            case 'brand':
                $model = Brand::class;
                break;
            case 'product':
                $model = Product::class;
                break;
            case 'banner':
                $model = Banner::class;
                break;
            case 'deals':
                $model = FlashDeal::class;
                break;
            case 'shop':
                $model = Shop::class;
                break;
            default:
                $model = null;
            }
            $resourceData = $model::where('id', $custom_page->resource_id)->first();
            if($custom_page->page_data != null){
                foreach($custom_page->page_data as $page_data){
                    $imageUrl = asset("public/assets/images/customePage/{$custom_page->id}/{$resourceData->id}/" . $page_data->image);
                    $page_data->imageurl = $imageUrl;
                }
            }

        return view('admin-views.custom-page.edit', compact('custom_page'));
    }

    public function UpdateCustomPage(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
            'resource_type'=>'required',
        ]);
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/custom_page/'), $filename);
        }
        CustomPage::where('id', $id)->update([
            'title' => $request->title,
            'image' => $filename,
            'resource_type' => $request->resource_type,
            'resource_id' => $request[$request->resource_type . '_id'],
        ]);
        Toastr::success('Custom Page Has Been Update');
            return redirect()->route('admin.custom-page.list');
    }

    public function DeleteCustomPage($id){
        $page = CustomPage::where('id', $id)->first();
        if($page != null){
            $page->delete();
            Toastr::success('Page Has Been Deleted!');
            return redirect()->back();
        }else{
            Toastr::error('No Page Found ');
            return redirect()->back();
        }
    }

    public function ImageStore(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'tags'=>'required',
            'url'=>'required',
        ]);
        $CustomPage = CustomPage::findOrFail($id);
        switch ($CustomPage->resource_type) {
            case 'category':
                $model = Category::class;
                break;
            case 'brand':
                $model = Brand::class;
                break;
            case 'product':
                $model = Product::class;
                break;
            case 'banner':
                $model = Banner::class;
                break;
            case 'deals':
                $model = FlashDeal::class;
                break;
            case 'shop':
                $model = Shop::class;
                break;
            default:
                $model = null;
            }
            $resourceData = $model::where('id', $CustomPage->resource_id)->first();
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path("assets/images/customePage/{$CustomPage->id}/{$resourceData->id}"), $filename);
        }else{
            $filename = null;
        }
        if($request->tags != null){
            $tagsString = $request->tags;
            $tagsArray = explode(', ', $tagsString);
        }else{
            $tagsArray = [];
        }

        CustomPageData::create([
            'custom_page_id' => $CustomPage->id,
            'image' => $filename,
            'tags' => json_encode($tagsArray),
            'url' => $request->url,
            'width' => $request->width,
            'margin_bottom' => $request->margin_bottom,
            'margin_right' => $request->margin_right,
        ]);

        Toastr::success('Your Image Has Been Added Into Your Page');
            return redirect()->back();
    }


    public function DeletePageData($id){
        $page_data = CustomPageData::where('id', $id)->first();
        if($page_data != null){
            $page_data->delete();
            Toastr::success('Image Has Been Deleted!');
            return redirect()->back();
        }else{
            Toastr::error('No Image Found ');
            return redirect()->back();
        }

    }
}
