<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polls = Poll::paginate(10);
        return view('admin-views.poll.list',compact(['polls']));
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
        // dd($request->all());
        $request->validate([
            'question' => 'required|string',
            'start_date' => 'date',
            'end_date' => 'date',
        ]);

        $poll = Poll::create([
            'question' => $request->question,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        $pollId = $poll->id;

        foreach($request->option as $option){
            PollOption::create([
                'poll_id' => $pollId,
                'option' => $option
            ]);
        }

        Toastr::success('Poll has Been Created !');
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
        $poll = Poll::where('id',$id)->with('poll_option')->first();
        return view('admin-views.poll.edit',compact(['poll']));
    }

    public function PollStatus(Request $request)
    {
        if ($request->status) {
            Poll::where('id', $request->id)->update([
                'status' => $request->status
            ]);
        } else {
            Poll::where('id', $request->id)->update([
                'status' => 0
            ]);
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $poll = Poll::find($request->id);
        $poll->update([
            'question' => $request->question,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        $poll_options =  PollOption::where('poll_id',$request->id)->get();
        foreach($poll_options as $option){
            $option->delete();
        }
        foreach($request->option as $option){
            PollOption::create([
                'poll_id' => $request->id,
                'option' => $option
            ]);
        }
        Toastr::success('Poll has Been Updated !');
        return redirect()->route('admin.poll.list');
    }

    public function destroy(string $id)
    {
        $poll = Poll::find($id);
        $poll_options =  PollOption::where('poll_id',$id)->get();
        foreach($poll_options as $option){
            $option->delete();
        }
        $poll->delete();
        Toastr::success('Poll Been Deleted !');
        return back();
    }
}
