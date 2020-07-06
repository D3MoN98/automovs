<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'blog_category_id', 'title', 'content', 'images'
    ];

    public function blog_category()
    {
        return $this->belongsTo('App\BlogCategory');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}