<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'instagram_post_code',
        'total',
        'max_id',
        'qtd_comments',
        'image',
        'finished'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id','id');
    }
}
