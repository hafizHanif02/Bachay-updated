<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class QuizQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizes = Quiz::get();
        $quiz_questions = QuizQuestion::with('quiz')->get();
        return view('admin-views.quiz-question.list', compact('quizes','quiz_questions'));
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
            $file->move(public_path('assets/images/quiz/question/'), $filename);
        }else{
            $filename = null;
        }

        $quizId = DB::table('quiz_questions')->insertGetId([
            'quiz_id' => $request->quiz_id,
            'question' => $request->question,
            'image' => $filename,
        ]);

            foreach($request->options as $option){
                $quizAnswerId = DB::table('quiz_answer')->insertGetId([
                    'answer' => $option,
                    'quiz_id' => $quizId,
                ]);

                $quiz_options = QuizAnswer::where('id', $quizAnswerId)->get();
                foreach($quiz_options as $quiz_option){
                    if($quiz_option->answer == $request->correct_answer){
                        $correct_answer_id = $quiz_option->id;
                    }
                }
            }

            QuizQuestion::where('id', $quizId)->update([
                'answer_id' => $correct_answer_id,
            ]);

            Toastr::success('Question Has Been Added');
            return redirect()->route('admin.customer.quiz.question.list');
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
    public function edit(string $id)
    {
        $quiz_question = QuizQuestion::where('id',$id)->with('quiz','answer')->first();
        $quizes = Quiz::get();
        return view('admin-views.quiz-question.edit', compact('quiz_question','quizes'));
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
            $file->move(public_path('assets/images/quiz/question/'), $filename);
        }else{
            $filename = null;
        }

        $quizId = DB::table('quiz_questions')->where('id', $request->id)->update([
            'question' => $request->question,
            'image' => $filename,
        ]);

            foreach($request->options as $option){
                $quiz_options = QuizAnswer::where('quiz_id', $request->id)->get();
                foreach($quiz_options as $quiz_option){
                    if($quiz_option->answer == $request->correct_answer){
                        $correct_answer_id = $quiz_option->id;
                    }
                }
            }

            QuizQuestion::where('id', $request->id)->update([
                'answer_id' => $correct_answer_id,
            ]);

            Toastr::success('Question Has Been Updated');
            return redirect()->route('admin.customer.quiz.question.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request){
        $quiz = QuizQuestion::find($request->id);
        $quiz->delete();
        Toastr::success('Question Deleted');
        return redirect()->route('admin.customer.quiz.question.list');
    }
}
