<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PhotoUser extends Pivot
{
    use HasFactory;
    public $table = 'photo_user';

    /**
     * Met en pause le model, si le user id est dans le bon grouip ça créer insert dans la db
     */
    protected static function booted()
    {
        static::creating(function ($photoUser) {
            if(!GroupUser::where('user_id', $photoUser->user->id)
                ->where('group_id', $photoUser->photo->group->id)
                ->exists()) return false;
        });
    }

    /**
     * retourne les user d'une photo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
public function user(){
    return $this->belongsTo(User::class);

}

    /**
     * retourne les photos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
public function photo(){
    return $this->belongsTo(Photo::class);
}
}
