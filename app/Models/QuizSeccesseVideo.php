<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizSeccesseVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'question_id',
        'answer_id',
        'rateSeccess',
        'Answercount'
    ];

    /**
     * Get the videoformtion that owns the QuizSeccesseVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function videoformtion(): BelongsTo
    {
        return $this->belongsTo(CoursFormationVideo::class, 'video_id');
    }

    /**
     * Get the user that owns the QuizSeccesseVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    /**
     * Get the answer that owns the QuizSeccesseVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }

}
