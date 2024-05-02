<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RolePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id' ,
        'permission_id',
        'confirmed'
    ];


    /**
     * Get the userrole that owns the RolePermission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userrole(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    

}
