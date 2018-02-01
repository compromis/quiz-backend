<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Add a score to the database
     *
     * @param string $quiz The Quiz ID
     *
     * @return Response
     */
    public function post_score($quiz, Request $request)
    {
        $scoreExists = app('db')
            ->table('scores')
            ->where('quiz', $quiz)
            ->where('fb_id', $request->input('fb_id'))
            ->get();

        if($scoreExists) {
            return response()->json([
                'status' => 'existed'
            ], 200);
        }

        $row = [
            'quiz' => $quiz,
            'fb_id' => $request->input('fb_id'),
            'name' => $request->input('name'),
            'score' => $request->input('score'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ];

        $insert = app('db')
            ->table('scores')
            ->insert($row);

        return response()->json([
            'status' => 'inserted'
        ], 200);
    }

    /**
     * Add individual quiz answers for statistical purposes
     *
     * @param string $quiz The Quiz ID
     *
     * @return Response
     */
    public function post_stats($quiz)
    {
        $row = [
            'quiz' => $quiz,
            'fb_id' => $request->input('fb_id'),
            'name' => $request->input('name'),
            'question_id' => $request->input('question_id'),
            'answer' => $request->input('answer'),
            'points' => $request->input('points'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ];

        $insert = app('db')
            ->table('stats')
            ->insert($row);

        return response()->json([
            'status' => 'inserted'
        ], 200);
    }

    /**
     * Retreive scores for user's friends
     *
     * @param string $quiz The Quiz ID
     *
     * @return Response
     */
    public function get_scores($quiz)
    {
        $friends = [];

        $scores = app('db')
            ->table('scores')
            ->select('fb_id', 'name', 'score')
            ->whereIn('fb_id', $friends)
            ->get();

        return response()->json($scores, 200);
    }
}
