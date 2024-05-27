<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cour extends Model
{
    use HasFactory , SoftDeletes;

     
    protected $fillable = [
        'title',
        'description',
        'tags',
        'category_id',
        'subcategory_id',
        'cours_type',
        'isActive',
        'isComing',
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
     * Get the category that owns the Cour
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class ,'category_id');
    }

    /**
     * Get the subcategory that owns the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SousCategory::class, 'subcategory_id');
    }


    /**
     * Get all of the goalcours for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goalcours(): HasMany
    {
        return $this->hasMany(CoursGoals::class, 'cours_id');
    }


    /**
     * Get the CoursConference associated with the Cour
     *
     * @return HasOne
     */
    public function CoursConference(): HasOne
    {
        return $this->hasOne(CoursConference::class, 'cours_id')->withTrashed();;
    }

    /**
     * Get the CoursPodcast associated with the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function CoursPodcast(): HasOne
    {
        return $this->hasOne(CoursPodcast::class, 'cours_id')->withTrashed();;
    }

    /**
     * Get the CoursFormation associated with the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function CoursFormation(): HasOne
    {
        return $this->hasOne(CoursFormation::class, 'cours_id')->withTrashed();;
    }


    /**
     * Get all of the QuizSeccess for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function QuizSeccess(): HasMany
    {
        return $this->hasMany(QuizSeccess::class, 'cours_id');
    }

    /**
     * Get all of the QuestionAnswers for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function QuestionAnswers(): HasMany
    {
        return $this->hasMany(QuestionAnswers::class, 'cours_id');
    }

    /**
     * Get all of the QuizQuestion for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function QuizQuestion(): HasMany
    {
        return $this->hasMany(QuizQuestion::class, 'cours_id');
    }

    /**
     * Get all of the favoris for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoris(): HasMany
    {
        return $this->hasMany(CoursFavoris::class, 'cours_id');
    }

    /**
     * Get all of the comments for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(CoursComment::class, 'cours_id');
    }

    /**
     * Get all of the viewcour for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function viewcour(): HasMany
    {
        return $this->hasMany(ViewCour::class, 'cours_id');
    }

    /**
     * Get all of the FineshedCours for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function FineshedCours(): HasMany
    {
        return $this->hasMany(FineshedCours::class, 'cours_id');
    }

}
