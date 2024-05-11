<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShortCours extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'host_id',
        'title',
        'image',
        'image_flex',
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

    /**
     * Get all of the shortgoal for the ShortCours
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shortgoal(): HasMany
    {
        return $this->hasMany(ShortGoal::class, 'cour_id');
    }
    

}
