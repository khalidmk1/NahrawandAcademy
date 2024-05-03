<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShortGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'cour_id',
        'goal_id'
    ];

    /**
     * Get the shortCours that owns the ShortGoal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shortCours(): BelongsTo
    {
        return $this->belongsTo(ShortCours::class, 'cour_id');
    }

    /**
     * Get the Goal that owns the ShortGoal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class, 'goal_id');
    }
}
