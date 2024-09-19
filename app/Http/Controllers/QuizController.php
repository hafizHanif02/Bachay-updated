<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizCategory;
use App\Models\QuizQuestion;
use App\Models\QuizSubmission;
use App\Models\FamilyRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Utils\Helpers;

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

    public function banner() {
        $quiz = Quiz::all();
    
        // Create a new array to store only the id and image
        $quizBanner = [];
    //public/assets/images/quiz
        foreach ($quiz as $value) {
            $quizBanner[] = [
                'id' => $value->id,
                'image' => asset('public/assets/images/quiz/' . $value->image)
            ];
        }
    
        // Return a JSON response with the id and image
        return response()->json(['quiz_banner' => $quizBanner], 200);
    }

    public function categories() {
        $quiz_categories = QuizCategory::get();

        foreach ($quiz_categories as $value) {
            $value->image = asset('public/assets/images/quiz/category/' . $value->image);
        }
        return response()->json($quiz_categories, 200);
    }

    public function categories_by_id($id) {
        $quiz = Quiz::where('quiz_category_id', $id)->get();

        foreach ($quiz as $value) {
            $value->image = asset('public/assets/images/quiz/' . $value->image);
        }

        $categories = QuizCategory::find($id);
        return response()->json(['quiz' => $quiz, 'categories' => $categories], 200);
    }

    public function popular() {
        $quiz = Quiz::take(2)->get();
        foreach ($quiz as $value) {
            $value->image = asset('public/assets/images/quiz/' . $value->image);
        }
        return response()->json($quiz, 200);
    }   
    
    public function most_recent(){
        $quiz = Quiz::take(2)->orderBy('created_at','desc')->get();
        foreach ($quiz as $value) {
            $value->image = asset('public/assets/images/quiz/' . $value->image);
        }
        return response()->json($quiz, 200);
    }

    public function quiz_view($id) {
       $quizQuestion = QuizQuestion::where("quiz_id",$id)->with('answer')->with('correctAnswer')->get();

       $quiz = Quiz::find($id)->with('quiz_category')->with('quiz_question')->first();

       $quiz_submission = QuizSubmission::where('quiz_id', $id)->get();
       $quiz_submission_count = Helpers::formatCount($quiz_submission->count());


       $topScore = self::getTopQuizResults($id);
       return response()->json([
        'id' => $quiz->id,
        'image' => asset('public/assets/images/quiz/' . $quiz->image),
        'category_name' => $quiz->quiz_category->name,
        'name' => $quiz->name,
        'question' => $quiz->quiz_question->count(),
        'played' => $quiz_submission_count, 
        'favorite' => 0, // need to work on this later
        'points' => 100, // need to work on this later
        'description' => $quiz->description,
        'top_score' => $topScore,
        'quiz_question' => $quizQuestion,
       ], 200);
    }

    public function submission(Request $request) {
        $validator = Validator::make($request->all(), [
            'child_id' => 'required',
            'quiz_question_id' => 'required',
            'quiz_answer_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $currentUser = $request->user();
        $childSelected = FamilyRelation::where('user_id', $currentUser->id)->where('id', $request->child_id)->with('parent')->get();
        
        if ($childSelected->count() > 0) {
            $childSelected = $childSelected[0];
        } else {
            return response()->json(['errors' => 'Child not found'], 403);
        }
        $quizQuestion = explode(",",$request->quiz_question_id);
        $quizAnswers = explode(",",$request->quiz_answer_id);

        if(count($quizAnswers) != count($quizQuestion)) {
            return response()->json(['errors' => 'Invalid Answer'], 403);
        }

        $quizID = QuizQuestion::where('id', $quizQuestion[0])->first()->quiz_id;
        $quizID = Quiz::where('id', $quizID)->first();

        foreach($quizQuestion as $key => $value) {
            $qID = QuizQuestion::where('id', $value)->first()->quiz_id;
            if($quizID->id != $qID) {
                return response()->json(['errors'=> 'Invalid Question'], 403);
            }
        }

        foreach($quizQuestion as $key => $value) {
            try {
                QuizSubmission::create([
                    'user_id' => $currentUser->id,
                    'child_id' => $childSelected->id,
                    'quiz_id' => $quizID->id,
                    'question_id' => $value,
                    'answer_id' => $quizAnswers[$key],
                ]);
            } catch (\Exception $exception) {
                return response()->json(['errors' => $exception->getMessage()], 403);
            }
        }


        return response()->json(['message' => 'Quiz Submitted'], 200);
    }

    public function getTopQuizResults($quizId)
    {
        // Fetch all submissions for the quiz, grouped by child
        $quizSubmissions = QuizSubmission::where('quiz_id', $quizId)
            ->get()
            ->groupBy('child_id');
        
        $results = [];

        foreach ($quizSubmissions as $childId => $submissions) {
            $totalQuestions = $submissions->count();
            $correctAnswers = 0;

            // Fetch child profile information
            $child = FamilyRelation::find($childId);
            
            // Calculate the total time spent on the quiz (example: you must calculate or store this in DB)
            $startTime = $submissions->first()->created_at;
            $endTime = $submissions->last()->updated_at;
            $totalTime = $endTime->diff($startTime);

            // Loop through each submission for the child to calculate score
            foreach ($submissions as $submission) {
                // Fetch the correct answer for the question
                $question = QuizQuestion::find($submission->question_id);

                if ($question && $question->answer_id == $submission->answer_id) {
                    // Answer is correct
                    $correctAnswers++;
                }
            }

            // Calculate the score (percentage or raw score)
            $score = $correctAnswers * ($totalQuestions / 100) . ' / 100';

            // Store the result for this child
            $results[] = [
                'child_id' => $childId,
                'child_name' => $child->name,
                'child_image' => asset($child->profile_picture), // Assuming profile_picture field exists
                'total_questions' => $totalQuestions,
                'correct_answers' => $correctAnswers,
                'score' => $score,
                'time_taken' => $totalTime->format('%i Mins %s Secs'), // Time in minutes and seconds
            ];
        }

        // Sort the results by correct answers, highest first
        usort($results, function ($a, $b) {
            return $b['correct_answers'] - $a['correct_answers'];
        });

        // Limit to top 5 results
        $topResults = array_slice($results, 0, 5);

        // Return the top results
        return $topResults;
    }
}
