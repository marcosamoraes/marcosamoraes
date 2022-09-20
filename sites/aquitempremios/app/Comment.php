<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'post_code',
        'comment_id',
        'comment_text',
        'comment_order',
        'username',
        'created_at',
        'updated_at'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
