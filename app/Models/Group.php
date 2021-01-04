<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * retourne les users du group
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function users(){
        return $this->belongsToMany(User::class)->using(GroupUser::class)->withPivot('id')->withTimestamps();
    }

    /**
     * retourne les photos du group
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos(){
        return $this->hasMany(Photo::class);
    }
}
