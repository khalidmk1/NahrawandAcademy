<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoProgressFormation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_id',
    ];

    /**
     * Get the user that owns the VideoProgressFormation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the videoConference that owns the VideoProgressFormation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function videoFrmation(): BelongsTo
    {
        return $this->belongsTo(CoursFormationVideo::class, 'video_id');
    }
}
