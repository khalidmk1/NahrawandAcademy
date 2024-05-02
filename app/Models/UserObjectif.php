<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserObjectif extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'objetif_id',
    ];

    /**
     * Get the user that owns the UserObjectif
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the goals that owns the UserObjectif
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goals(): BelongsTo
    {
        return $this->belongsTo(User::class, 'objetif_id');
    }
}
