<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\QnaAnswer;
use App\Models\QnaQuestion;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class QnaQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = QnaQuestion::with(['user','answers'])->get();
        $users = User::get();
        return view('admin-views.qna.question.list', compact('questions','users'));
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

        if ($validator->fails()) {
            Toastr::error($validator->errors()->first()); 
            return back(); 
        }

        QnaQuestion::create([
            'question' => $request->question,
            'user_id' => $request->user_id
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
    public function edit($id)
    {
        $question = QnaQuestion::where('id',$id)->first();
        $users = User::get();
        return view('admin-views.qna.question.edit', compact('question','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error($validator->errors()->first()); 
            return back(); 
        }

        QnaQuestion::where('id', $request->id)->update([
            'question' => $request->question,
            'user_id' => $request->user_id
        ]);
        Toastr::success(translate('question_updated_successfully'));
        return redirect()->route('admin.customer.qna.question.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        QnaQuestion::where('id', $request->id)->delete();
        QnaAnswer::where('question_id', $request->id)->delete();
        Toastr::success(translate('question_deleted_successfully'));
        return back();
    }
}
