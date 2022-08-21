<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Quiz;
use App\Models\QuizHasQuestion;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $quiz=new Quiz();
        $quiz->title='Quiz';
        $quiz->passing_score=80;
        $quiz->quiz_time=5;
        $quiz->save();

        $question = new Question();
        $question->title= "Question 1";
        $question->save();


        $quizHasQuestion=new QuizHasQuestion();
        $quizHasQuestion->question_id=$question->id;
        $quizHasQuestion->quiz_id=$quiz->id;
        $quizHasQuestion->save();

        $question1 = new Question();
        $question1->title= "Question 2";
        $question1->save();

        $quizHasQuestion=new QuizHasQuestion();
        $quizHasQuestion->question_id=$question1->id;
        $quizHasQuestion->quiz_id=$quiz->id;
        $quizHasQuestion->save();

        $question2 = new Question();
        $question2->title= "Question 3";
        $question2->save();

        $quizHasQuestion=new QuizHasQuestion();
        $quizHasQuestion->question_id=$question2->id;
        $quizHasQuestion->quiz_id=$quiz->id;
        $quizHasQuestion->save();

        $question3 = new Question();
        $question3->title= "Question 4";
        $question3->save();

        $question4 = new Question();
        $question4->title= "Question 5";
        $question4->save();

        $questionOption = new QuestionOption();
        $questionOption->answer_option = "Answer 1";
        $questionOption->question_id = $question->id;
        $questionOption->is_correct = 1;
        $questionOption->save();

        $questionOption1 = new QuestionOption();
        $questionOption1->answer_option = "Answer 2";
        $questionOption1->question_id = $question->id;
        $questionOption1->is_correct = 0;
        $questionOption1->save();

        $questionOption2 = new QuestionOption();
        $questionOption2->answer_option = "Answer 1";
        $questionOption2->question_id = $question1->id;
        $questionOption2->is_correct = 0;
        $questionOption2->save();


        $questionOption3 = new QuestionOption();
        $questionOption3->answer_option = "Answer 2";
        $questionOption3->question_id = $question1->id;
        $questionOption3->is_correct = 1;
        $questionOption3->save();

        $questionOption4 = new QuestionOption();
        $questionOption4->answer_option = "Answer 1";
        $questionOption4->question_id = $question2->id;
        $questionOption4->is_correct = 1;
        $questionOption4->save();

        $questionOption5 = new QuestionOption();
        $questionOption5->answer_option = "Answer 2";
        $questionOption5->question_id = $question2->id;
        $questionOption5->is_correct = 0;
        $questionOption5->save();

        $questionOption6 = new QuestionOption();
        $questionOption6->answer_option = "Answer 1";
        $questionOption6->question_id = $question3->id;
        $questionOption6->is_correct = 0;
        $questionOption6->save();

        $questionOption7 = new QuestionOption();
        $questionOption7->answer_option = "Answer 2";
        $questionOption7->question_id = $question3->id;
        $questionOption7->is_correct = 1;
        $questionOption7->save();

        $questionOption8 = new QuestionOption();
        $questionOption8->answer_option = "Answer 1";
        $questionOption8->question_id = $question4->id;
        $questionOption8->is_correct = 1;
        $questionOption8->save();

        $questionOption9 = new QuestionOption();
        $questionOption9->answer_option = "Answer 2";
        $questionOption9->question_id = $question4->id;
        $questionOption9->is_correct = 0;
        $questionOption9->save();


        $quizHasQuestion=new QuizHasQuestion();
    }
}
