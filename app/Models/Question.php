<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function questionhasOption()
    {
        return $this->hasMany(QuestionOption::class, 'question_id', 'id');
    }

    public function quizOption()
    {
        return $this->hasOne(QuestionOption::class, 'question_id', 'id');
    }
    public function quiz()
    {
        return $this->hasOne(Quiz::class, 'quiz_has_questions', 'quiz_id');
    }
}
