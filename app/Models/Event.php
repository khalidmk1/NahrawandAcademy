<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'host_id',
        'image',
        'video',
        'url',
        'title',
        'description',
        'date_start',
        'date_end',
    ];


}
