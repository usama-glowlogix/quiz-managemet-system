<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizHasQuestion extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quiz_has_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'quiz_id',
    ];
    // public function getImageAttribute($value)
    // {
    //     if ($value == null) {
    //         return null;
    //     } else {
    //         return asset('/assets/images/pet/' . $value);
    //     }
    // }

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

    public function quizHasQuestion()
    {
        return $this->belongsToMany(Question::class, 'question_id');
    }
}
