<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoProgressConference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_id',
    ];


    /**
     * Get the user that owns the VideoProgressconference
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the videoConference that owns the VideoProgressconference
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function videoConference(): BelongsTo
    {
        return $this->belongsTo(CoursConferenceVideo::class, 'video_id');
    }

}
