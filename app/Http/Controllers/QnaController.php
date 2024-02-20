<?php

namespace App\Http\Controllers;

use App\Models\QnaQuestion;
use Illuminate\Http\Request;

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
            return view('admin-views.qna.list', compact('questions'));}
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
        //
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
