<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    use HasFactory;

    /**
     * Met en pause la création du model si l'user id est dans le bon group ça créer le commentaire
     */

    protected static function booted()
    {
        static::creating(function ($comment) {
            if(!GroupUser::where('user_id', $comment->user->id)
                ->where('group_id', $comment->photo->group->id)
                ->exists()) return false;
        });
    }




    /**
     * retourne la photo auquel appartient les commentaires
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo(){
        return $this->BelongsTo(Photo::class);
    }

    /**
     * retourne l'user auquel appartient le commentaire
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * retourne les réponses des commentaires
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(){
        return $this->hasMany(Comment::class, 'comment_id');
    }

    /**
     * retourne une réponse
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function replyTo()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }
}
