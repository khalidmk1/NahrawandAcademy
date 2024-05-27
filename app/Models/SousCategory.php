<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SousCategory extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'category_id',
        'Descripion',
        'souscategory_name'
    ];


   /**
     * Get the category that owns the souscategory.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    /**
     * Get all of the goals for the SousCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class, 'souscategory_id');
    }

    /**
     * Get all of the cours for the SousCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cours(): HasMany
    {
        return $this->hasMany(Cour::class, 'subcategory_id');
    }

    /**
     * Get all of the subcategoryuser for the SousCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategoryuser(): HasMany
    {
        return $this->hasMany(SubCategoryUser::class, 'subcategory_id');
    }



}
