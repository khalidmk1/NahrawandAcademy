<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoProgressPodcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_id',
    ];

    /**
     * Get the user that owns the VideoProgressPodcast
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the CoursPadcastVideo that owns the VideoProgressPodcast
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function VideoPadcas(): BelongsTo
    {
        return $this->belongsTo(CoursPadcastVideo::class, 'video_id');
    }
}
