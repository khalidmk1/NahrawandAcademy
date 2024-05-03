<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShortCours extends Model
{
    use HasFactory;

    protected $fillable = [
        'host_id',
        'title',
        'image',
        'video',
        'tags'
    ];


     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array',
    ];

    /**
     * Get the user that owns the ShortCours
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    /**
     * Get all of the shortCours for the ShortCours
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shortCours(): HasMany
    {
        return $this->hasMany(ShortGoal::class, 'cour_id');
    }

}
