<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;


    protected $table = 'posts';
    protected $fillable = ['category_id', 'title', 'body'];

     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function replies()
    {
    	return $this->hasMany('App\Reply');
    } 
}
