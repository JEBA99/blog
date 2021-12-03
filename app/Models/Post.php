<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category() {
        //hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
        
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    // protected $fillable = ['title', 'excerpt', 'body', 'id'];

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    // public static function create($attributes) 
    // {
        
    //     $post = new Post;
    //     ddd($post);
    //     $post -> title = $attributes -> title;
    //     $post -> excerpt = $attributes -> excerpt;
    //     $post -> body = $attributes -> body;
    //     $post -> category_id = $attributes -> category_id;
    //     $post -> save();

    //     return Redirect::back();
    // }


}
