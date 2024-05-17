<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FineshedCours extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cours_id'
    ];


    /**
     * Get the user that owns the FineshedCours
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the Cours that owns the FineshedCours
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Cours(): BelongsTo
    {
        return $this->belongsTo(Cour::class, 'cours_id');
    }


}
