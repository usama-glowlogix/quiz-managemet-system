<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use App\Models\QuestionOption;
use Session;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('questionHasOption')->orderby('created_at', 'desc')->get();
        return view('admin.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.question.create');
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
        $question = Question::create($data);
        if (isset($request->question_option)) {
            foreach ($request->question_option as $key=> $option) {
                $questionOption=new QuestionOption();
                $questionOption->question_id = $question->id;
                $questionOption->answer = $option;
                if ($request->is_correct[$key] != null) {
                    $questionOption->is_correct = 1;
                } else {
                    $questionOption->is_correct = 0;
                }
                $questionOption->save();
            }
            if (!array_search('Correct Answer', $request->is_correct)) {
                $questionOptions = QuestionOption::where('question_id', $question->id)->get();
                foreach ($questionOptions as $option) {
                    $option->is_correct = 1;
                    $option->save();
                    break;
                }
            }
        }
        Session::flash('alert-success', 'Question updated successfully');
        return redirect('/admin/question');
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
        $question = Question::with('questionHasOption')->find($id);
        return view('admin.question.edit', compact('question'));
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
            'question' => 'required', 'string', 'max:255',
            ]);
        if ($validator->fails()) {
            return response()->json(['failed' => $validator->errors()]);
        }
        $id=$request->id;
        $question = Question::find($request->id);
        $question->question = $request->question;
        $question->save();
        if (isset($request->question_option)) {
            if (isset($request->db_id)) {
                foreach ($request->db_id as $db_id) {
                    $questionOptionId = explode(',', $db_id);
                    $questionOption = QuestionOption::find($questionOptionId[0]);
                    $questionOption->answer = $request->question_option[$questionOptionId[1]];
                    if ($request->is_correct[$questionOptionId[1]] != null) {
                        $questionOption->is_correct = 1;
                    } else {
                        $questionOption->is_correct = 0;
                    }
                    $questionOption->save();
                    $removeID[] = $questionOptionId[1];
                }
            }
            if (isset($removeID)) {
                foreach ($request->question_option as $key => $option) {
                    if (!in_array($key, $removeID)) {
                        $questionOption = new QuestionOption();
                        $questionOption->question_id = $id;
                        $questionOption->answer = $option;
                        if ($request->is_correct[$key] != null) {
                            $questionOption->is_correct = 1;
                        } else {
                            $questionOption->is_correct = 0;
                        }
                        $questionOption->save();
                    }
                }
                $questionOptions = QuestionOption::where('question_id', $id)->get();
                foreach ($questionOptions as $option) {
                    if (!in_array($option->answer, $request->question_option)) {
                        $option->delete();
                    }
                }
            } else {
                foreach ($request->question_option as $key => $option) {
                    $questionOption = new QuestionOption();
                    $questionOption->question_id = $id;
                    $questionOption->answer = $option;
                    if ($request->is_correct[$key] != null) {
                        $questionOption->is_correct = 1;
                    } else {
                        $questionOption->is_correct = 0;
                    }
                    $questionOption->save();
                }
            }
            if (!array_search('Correct Answer', $request->is_correct)) {
                $questionOptions = QuestionOption::where('question_id', $request->id)->get();
                foreach ($questionOptions as $option) {
                    $option->is_correct = 1;
                    $option->save();
                    break;
                }
            }
        } else {
            $questionOptions = QuestionOption::where('question_id', $request->id)->delete();
        }
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
}
