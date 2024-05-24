<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'image',
        'url',
        'title',
        'description',
        'date_start',
        'date_end',
    ];


    /**
     * Get all of the userevent for the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userevent(): HasMany
    {
        return $this->hasMany(UserEvent::class, 'event_id');
    }

}
