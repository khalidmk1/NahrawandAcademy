<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategoryUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subcategory_id'
    ];

    /**
     * Get the user that owns the SubCategoryUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the subcategory that owns the SubCategoryUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SousCategory::class, 'subcategory_id');
    }
    
}
