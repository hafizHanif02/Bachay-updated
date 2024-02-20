<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\QnaAnswer;
use App\Models\QnaQuestion;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;


class QnaAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answers = QnaAnswer::with(['user','question'])->get();
        $questions =  QnaQuestion::get();
        $users = User::get();
        return view('admin-views.qna.answer.list', compact('answers','users','questions'));
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
            'user_id' => 'required', 
            'answer' => 'required',
            'question_id' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error($validator->errors()->first()); 
            return back(); 
        }

        QnaAnswer::create([
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'user_id' => $request->user_id
        ]);

        Toastr::success(translate('answer_added_successfully'));
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
    public function edit($id)
    {
        $answer = QnaAnswer::where('id',$id)->with('user','question')->first();
        $users = User::get();
        $questions =  QnaQuestion::get();
        return view('admin-views.qna.answer.edit', compact('answer','users','questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required', 
            'answer' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error($validator->errors()->first()); 
            return back(); 
        }

        QnaAnswer::where('id',$request->id)->update([
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'user_id' => $request->user_id
        ]);

        Toastr::success(translate('answer_updated_successfully'));
        return redirect()->route('admin.customer.qna.answer.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        QnaAnswer::where('id',$id)->delete();
        Toastr::success(translate('answer_deleted_successfully'));
        return back();
    }
}
