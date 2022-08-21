<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use App\Models\QuestionOption;
use Session;
use App\Models\Quiz;
use App\Models\QuizHasQuestion;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('questions')->orderby('created_at', 'desc')->get();
        return view('admin.quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions=Question::all();
        return view('admin.quiz.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $validator = Validator::make($data, [
            'question' => 'required', 'string', 'max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['failed' => $validator->errors()]);
        }
        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->passing_score = $request->passing_score;
        $quiz->quiz_time = $request->quiz_time;
        $quiz->save();
        if (isset($request->question)) {
            foreach ($request->question as $questionID) {
                $question = Question::find($questionID);
                $question->quiz_id = $quiz->id;
                $questionHasQuiz=new QuizHasQuestion();
                $questionHasQuiz->question_id=$question->id;
                $questionHasQuiz->quiz_id=$quiz->id;
                $questionHasQuiz->save();
            }
        }
        Session::flash('alert-success', 'Question updated successfully');
        return redirect('/admin/quiz');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::with('questions')->find($id);
        $questions=Question::all();
        return view('admin.quiz.edit', compact('quiz', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=$request->all();
        $validator = Validator::make($data, [
            'title' => 'required', 'string', 'max:255',
            ]);
        if ($validator->fails()) {
            return response()->json(['failed' => $validator->errors()]);
        }
        $question = Question::updateOrCreate(['id' => $request->id], $data);
        $questionOption =QuestionOption::where('question_id', $request->id)->first();
        $questionOption->answer=$request->answer;
        if ($request->has('is_correct')) {
            $questionOption->is_correct=1;
        } else {
            $questionOption->is_correct=0;
        }
        $questionOption->save();
        if ($question) {
            Session::flash('alert-success', 'Question updated successfully');
            return redirect('/admin/question');
        }
    }
    public function destroy($id)
    {
        $new = Question::findOrFail($id);
        $new->delete();
        Session::flash('alert-success', 'Deleted successfully');
        return redirect('/admin/question');
    }

    public function attempQuiz()
    {
        $quizzes = Quiz::with('questions')->orderby('created_at', 'desc')->get();
        return view('admin.quiz.index', compact('quizzes'));
    }
}
