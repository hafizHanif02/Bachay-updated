<?php

namespace App\Http\Controllers;

use App\Models\QnaQuestion;
use Illuminate\Http\Request;
use App\Models\ParentArticleCategory;
use App\Models\User;
use App\Models\QnaAnswer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class QnaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(){
        $questions = QnaQuestion::with('answers.user', 'user')->get();

        if ($questions->isNotEmpty()) {
            foreach ($questions as $question) {
                if ($question->user->image != null) {
                    $questionImageUrl = asset('public/assets/images/customers/' . $question->user->image);
                    $question->user->avatar = $questionImageUrl;
                }

                foreach ($question->answers as $answer) {
                    if ($answer->user->image != null) {
                        $answerImageUrl = asset('public/assets/images/customers/' . $answer->user->image);
                        $answer->user->avatar = $answerImageUrl;
                    }
                }
            }
        }
        return view('admin-views.qna.list', compact('questions'));
    }
    public function parenting_question()
    {
        $myquestions = QnaAnswer::where('user_id', auth('customer')->id())->get();
        return view(VIEW_FILE_NAMES['parenting-question'], compact('myquestions'));
    }

    public function parenting_answer()
    {
        $myanswers = QnaAnswer::where('user_id', auth('customer')->id())->get();
        return view(VIEW_FILE_NAMES['parenting-answer'], compact('myanswers'));
    }
    public function QnaHome(){
        $parent_article_categories = ParentArticleCategory::where('status', 1)->with('child')->latest()->take(5)->get();
        $questions = QnaQuestion::with('answers.user', 'user','child')->get();
        return view('theme-views.question-answer.question-answer', compact('parent_article_categories','questions'));
    }
    public function View_more_answer($id){
        $parent_article_categories = ParentArticleCategory::where('status', 1)->with('child')->latest()->take(5)->get();
        // $questions = QnaQuestion::where('id', $id)->with('answers.user', 'user')->first();
        $answers = QnaAnswer::where('question_id', $id)->with('user')->get();
        return view('theme-views.question-answer.view-more-answer', compact('parent_article_categories','answers'));
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
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'user_id' => 'required',
        ]);

        if (!$request->has('user_id') || !$validator->passes()) {
            Toastr::error('Please login first.'); 
            return redirect()->route('customer.auth.login'); 
        }

        if ($validator->fails()) {
            Toastr::error($validator->errors()->first()); 
            return back(); 
        }

        QnaQuestion::create([
            'question' => $request->question,
            'user_id' => $request->user_id,
            'child_id' => ($request->child_id ?? '')
        ]);

        Toastr::success(translate('question_added_successfully'));
        return back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
