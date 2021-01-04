<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use phpDocumentor\Reflection\Utils;

class Photo extends Model
{
    use HasFactory, Notifiable;
    protected static function booted()
    {
        /**
         * permet de mettre en pose la création, pour vérifier que l'utilisateur est dans le groupe pour creer la photo dans ce meme groupe
         *
         * @param Illuminate\Database\Eloquent\Model;
         * @return boolean;
         */
        static::creating(function($photo){
            if(!GroupUser::where('user_id', $photo->owner->id)
            ->where('group_id', $photo->group->id)->exists())
                return false;
        });
    }

    /**
     * retourne les users de la photo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function users()
    {
    return $this->belongsToMany(User::class)->using(PhotoUser::class)->withPivot("id")->withTimestamps();
    }

    /**
     * retourne les commentaires d'une photo
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * retourne les tags d'un photo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function tags(){
        return $this->belongsToMany(Tag::class)->using(PhotoTag::class)->withPivot('id')->withTimestamps();
    }

    /**
     * retourne les users d'une photo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * retourne le groups de la photo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function group(){
        return $this->belongsTo(Group::class);
    }

    /**
     * retourne l'owner de la  photo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
