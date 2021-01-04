<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupUser extends Pivot
{
    use HasFactory;
    public $table = 'group_user';

    /**
     * retourne les users qui sont dans les groups
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * retourne les groups crées
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    protected $fillable = [
        'group_id',
        'user_id',
        'created_at',
        'updated_at'];
}
