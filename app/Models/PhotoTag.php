<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Notifications\Notifiable;

class PhotoTag extends Pivot
{
    use HasFactory, Notifiable;
    public $table = 'photo_tag';

    /**
     * retourne les tags d'une photo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    /**
     * retourne les photos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function photo(){
        return $this->belongsTo(Photo::class);
    }
}
