<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizes = Quiz::with(['quiz_category'])->get();
        $quiz_categories = QuizCategory::get();
        foreach($quiz_categories as $quiz_category){
            $quiz_category->image = asset('public/assets/images/quiz/category/'.$quiz_category->image);
        }
        foreach($quizes as $quiz){
            $quiz->image = asset('public/assets/images/quiz/'.$quiz->image);
        }
        return view('admin-views.quiz.list', compact('quizes','quiz_categories'));
    }
    public function quiz_index(){
        $quizes = Quiz::with(['quiz_category'])->get();
        $quiz_categories = QuizCategory::get();
        foreach($quiz_categories as $quiz_category){
            $quiz_category->image = asset('public/assets/images/quiz/category/'.$quiz_category->image);
        }
        foreach($quizes as $quiz){
            $quiz->image = asset('public/assets/images/quiz/'.$quiz->image);
        }
        return view('theme-views.quiz.quiz', compact('quizes','quiz_categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            $file->move(public_path('assets/images/quiz/'), $filename);
        }else{
            $filename = null;
        }
        $request->validate([
            'quiz_category_id' => 'required',
            'name' => 'required',
            'expiry_date' => 'required',
        ]);
        $quizId = DB::table('quiz')->insertGetId([
            'quiz_category_id' => $request->quiz_category_id,
            'name' => $request->name,
            'image' => $filename,
            'expiry_date' => $request->expiry_date,
        ]);
        Toastr::success('Quiz Added');
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
        $quiz = Quiz::with('quiz_category')->where('id',$id)->first();
        $quiz_categories = QuizCategory::get();
        return view('admin-views.quiz.edit', compact('quiz','quiz_categories'));
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
            $file->move(public_path('assets/images/quiz/'), $filename);
        }else{
            $filename = null;
        }
        $request->validate([
            'quiz_category_id' => 'required',
            'name' => 'required',
            'expiry_date' => 'required',
        ]);
    
        $correct_answer_id = null; // Initialize outside the loop
    
        DB::table('quiz')->where('id', $request->id)->update([
            'quiz_category_id' => $request->quiz_category_id,
            'name' => $request->name,
            'image' => $filename,
            'expiry_date' => $request->expiry_date,
        ]);

        Toastr::success('Quiz Updated');
    return redirect()->route('admin.customer.quiz.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request){
        $quiz = Quiz::find($request->id);
        $quiz->delete();
        Toastr::success('Quiz Deleted');
        return redirect()->back();
    }
}
