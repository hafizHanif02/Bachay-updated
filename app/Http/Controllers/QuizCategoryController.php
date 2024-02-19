<?php

namespace App\Http\Controllers;

use App\Models\QuizCategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class QuizCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quiz_categories = QuizCategory::get();
        foreach($quiz_categories as $quiz_category){
            $quiz_category->image = asset('public/assets/images/quiz/category/'.$quiz_category->image);
        }
        return view('admin-views.quiz-category.list', compact('quiz_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/quiz/category/'), $filename);
        }
        QuizCategory::create([
            'name' => $request->name,
            'expiry' => $request->expiry,
            'image' => $filename,
        ]);
        Toastr::success('Quiz Category Added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = QuizCategory::find($id);
        return view('admin-views.quiz-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/quiz/category/'), $filename);
        }
        QuizCategory::where('id', $request->id)->update([
            'name' => $request->name,
            'expiry' => $request->expiry,
            'image' => $filename,
        ]);
        Toastr::success('Quiz Category Updated');
        return redirect()->route('admin.customer.quiz.quiz-category.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $quiz_categories = QuizCategory::find($request->id);
        $quiz_categories->delete();
        Toastr::success('Quiz Category Deleted');
        return redirect()->back();
    }
}
