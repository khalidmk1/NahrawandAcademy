<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domain extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'domain',
    ];


    /**
     * Get the user associated with the Domain
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function category(): hasMany
    {
        return $this->hasMany(category::class,);
    }
}
