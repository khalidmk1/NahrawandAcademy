<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursGoals extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'cours_id',
        'goal_id',
    ];


    /**
     * Get the cours that owns the CoursGoals
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours(): BelongsTo
    {
        return $this->belongsTo(Cour::class, 'cours_id');
    }

    /**
     * Get the Goal that owns the CoursGoals
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goalcours(): BelongsTo
    {
        return $this->belongsTo(Goal::class, 'goal_id');
    }
}
