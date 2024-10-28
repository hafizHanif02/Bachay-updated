<?php

namespace App\Http\Controllers;

use App\Models\QA;
use App\Models\QATag;
use App\Models\User;
use App\Models\QAAnswer;
use App\Models\QAAnswerLike;
use App\Models\Upvote;
use App\Models\Downvote;
use App\Models\QAFollower;
use App\Models\UserFollower;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;



class QAController extends Controller
{
    public function tags_list()
    {
        return response()->json(['status' => 1, 'message' => 'Tags list', 'data' => QATag::get(['id', 'tag'])], 200);
    }

    public function qa_list(Request $request)
    {
        $query = QA::with(['answers' => function($query) {
            // Load likes count for each answer
            $query->withCount('likes');
        }])
        ->withCount('followers', 'upvotes', 'downvotes')
        ->with('userDetails')
        ->with('child');
       



        // Check if the request contains a tag parameter and filter the questions
        if ($request->has('tag')) {
            $tag = $request->input('tag');
            // Apply the filter using 'like' for a case-insensitive search
            $query->where('question', 'like', '%' . $tag . '%');
        }

        // Get the filtered results
        $qaList = $query->get();
        
        foreach ($qaList as $qa) {
            // Ensure user details and image exists before updating
            if (!empty($qa->userDetails) && !empty($qa->userDetails->image)) {
                // Check if the image is already a full URL or not
                if (!preg_match('/^http/', $qa->userDetails->image)) {
                    $qa->userDetails->image = asset('uploads/profile_pictures/' . $qa->userDetails->image); 
                }
            }

            // Ensure child and profile picture exist before updating
            if (!empty($qa->child) && !empty($qa->child->profile_picture)) {
                // Check if the profile picture is already a full URL or not
                if (!preg_match('/^http/', $qa->child->profile_picture)) {
                    $qa->child->profile_picture = asset('uploads/children_profile_pictures/' . $qa->child->profile_picture); 
                }
            }
        }

        return response()->json([
            'status' => 1, 
            'message' => 'Q&A list', 
            'data' => $qaList
        ], 200);
    }

    

    public function qa_submit(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'child_id' => 'nullable|integer|exists:family_relation,id',  // Optional child ID
            'is_anonymous' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Image validation
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Prepare data for saving
        $data = [
            'user_id' => $request->user()->id,
            'childID' => $request->child_id ?? 0,
            'question' => $request->question,
            'is_anonymous' => $request->is_anonymous ?? false,
            'created_at' => now(),
        ];

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/qa_images'), $imageName);
            $data['image'] = 'uploads/qa_images/' . $imageName;  // Save path to image
        }

        // Insert the question into the QA table
        $qa = QA::create($data);

        // Return success response
        return response()->json([
            'message' => 'Question submitted successfully',
            'question' => $qa
        ], 201);
    }

    public function qa_answer_submit(Request $request)
    {
        // Step 1: Validate input
        $validator = Validator::make($request->all(), [
            'qa_id' => 'required|exists:QA,id', // Ensure QA exists
            'answer' => 'required|string', // The answer text is required
            'is_expert' => 'nullable|boolean', // Optional field to mark as expert
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Image validation (optional)
        ]);
    
        // Handle validation errors
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Step 2: Prepare data for saving the answer
        $data = [
            'userID' => $request->user()->id, // Logged-in user's ID
            'QA_id' => $request->qa_id, // QA ID (the question being answered)
            'QA_answer' => $request->answer, // The answer text
            'isExpert' => $request->is_expert ?? false, // Whether the answer is from an expert or not
            'created_at' => now(), // Only created_at is needed if there's no updated_at field
        ];
    
        // Step 3: Handle optional image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/qa_answers'), $imageName);
            $data['image'] = 'uploads/qa_answers/' . $imageName;  // Save image path to the database
        }
    
        // Step 4: Insert the answer into the QAAnswer table
        $answer = QAAnswer::create($data);
    
        // Step 5: Return success response
        return response()->json([
            'status' => 1,
            'message' => 'Answer submitted successfully',
            'answer' => $answer
        ], 201);
    }

    public function upvoteQA(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'qa_id' => 'required|exists:QA,id',
        ]);

        // If validation fails, return a 422 response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $qaId = $request->get('qa_id');
        $userId = $request->user()->id;

        // Check if the user has already upvoted the QA
        $existingUpvote = Upvote::where('QA_id', $qaId)->where('userID', $userId)->first();

        if ($existingUpvote) {
            return response()->json(['message' => 'You have already upvoted this question'], 400);
        }

        // Create a new upvote
        Upvote::create([
            'QA_id' => $qaId,
            'userID' => $userId
        ]);

        return response()->json(['message' => 'Upvote successful'], 200);
    }


    public function downvoteQA(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'qa_id' => 'required|exists:QA,id',
        ]);

        // If validation fails, return a 422 response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $qaId = $request->get('qa_id');
        $userId = $request->user()->id;

        // Check if the user has already downvoted the QA
        $existingDownvote = Downvote::where('QA_id', $qaId)->where('userID', $userId)->first();

        if ($existingDownvote) {
            return response()->json(['message' => 'You have already downvoted this question'], 400);
        }

        // Create a new downvote
        Downvote::create([
            'QA_id' => $qaId,
            'userID' => $userId
        ]);

        return response()->json(['message' => 'Downvote successful'], 200);
    }


    public function followQA(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'qa_id' => 'required|exists:QA,id',
        ]);

        // If validation fails, return a 422 response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $qaId = $request->get('qa_id');
        $userId = $request->user()->id;

        // Check if the user is already following the QA
        $existingFollower = QAFollower::where('QA_id', $qaId)->where('userID', $userId)->first();

        if ($existingFollower) {
            return response()->json(['message' => 'You are already following this question'], 400);
        }

        // Create a new follower
        QAFollower::create([
            'QA_id' => $qaId,
            'userID' => $userId
        ]);

        return response()->json(['message' => 'You are now following this question'], 200);
    }

    public function likeQAAnswer(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'qa_answer_id' => 'required|exists:QA_answer,id',
        ]);

        // If validation fails, return a 422 response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $qaAnswerId = $request->get('qa_answer_id');
        $userId = $request->user()->id;

        // Check if the user has already liked the QA answer
        $existingLike = QAAnswerLike::where('QA_ans_id', $qaAnswerId)->where('userID', $userId)->first();

        if ($existingLike) {
            return response()->json(['message' => 'You have already liked this answer'], 400);
        }

        // Create a new like for the QA answer
        QAAnswerLike::create([
            'QA_ans_id' => $qaAnswerId,
            'userID' => $userId
        ]);

        return response()->json(['message' => 'You have liked this answer'], 200);
    }

    public function currentUserProfile(Request $request)
    {
        // Get the logged-in user
        $user = $request->user(); 

        // Check if the user exists
        if (!$user) {
            return response()->json(['status' => 0, 'message' => 'User not found'], 404);
        }

        // Fetch the user's followers, answers, posts (QAs), upvotes, and likes count
        $userData = [
            'id' => $user->id,
            'f_name' => $user->f_name,
            'l_name' => $user->l_name,
            'image' => asset('uploads/profile_pictures/' . $user->image),
            'followers_count' => $user->followers()->count(),
            'answers_count' => $user->answers()->count(),
            'posts_count' => $user->qa()->count(),  // Assuming `qa()` is the relation to user's questions (posts)
            'upvotes_count' => $user->upvotes()->count(),
            'likes_count' => $user->likes()->count()
        ];

        // Fetch the user's QAs with their answers and upvotes/downvotes count for each QA
        $qaList = QA::withCount('upvotes', 'downvotes', 'followers')
                    ->with(['answers' => function($query) {
                        // Load likes count for each answer
                        $query->withCount('likes');
                    }])
                    ->where('user_id', $user->id)
                    ->get();

        // Append the questions and answers to the user data
        $userData['questions'] = $qaList;

        // Return user profile data
        return response()->json([
            'status' => 1,
            'message' => 'User profile details',
            'data' => $userData
        ], 200);
    }

    public function followUser(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'followed_user_id' => 'required|exists:users,id',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $followerId = $request->user()->id; // Current logged-in user
        $followedUserId = $request->input('followed_user_id');

        // Check if the user is already following
        $existingFollow = UserFollower::where('userID', $followerId)
                                    ->where('followed_user_id', $followedUserId)
                                    ->first();

        if ($existingFollow) {
            return response()->json(['message' => 'You are already following this user'], 400);
        }

        // Create a new follow entry
        UserFollower::create([
            'userID' => $followerId,
            'followed_user_id' => $followedUserId
        ]);

        return response()->json(['message' => 'You are now following this user'], 200);
    }


}
