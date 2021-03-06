<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Post extends Model
// {
//     use HasFactory;
// }

class Post {
    public $title;

    public $excerpt;

    public $date;

    public $body;

    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug) {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all() {
        // $files = File::files(resource_path("posts/"));
        
        // return array_map(fn($file) => $file->getContents(), $files);
        return cache()->rememberForever('posts.all', function() {
            return collect(File::files(resource_path("posts")))
                ->map(fn($file) => YamlFrontMatter::parseFile($file))
                ->map(fn($document) =>            
                    new Post(
                        $document -> title,
                        $document -> excerpt,
                        $document -> date,
                        $document -> body(),
                        $document -> slug,
                ))
                ->sortByDesc('date');
        });
        
        // return array_map(function ($file) {
        //     return $file->getContents();
        // }, $files);
    }

    public static function find($slug) {
        return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug) {

        $post = static::find($slug);

        if(! $post) {
            throw new ModelNotFoundException();
        }

        return $post;
        // dd($posts->firstWhere('slug', $slug));
        // if(! file_exists( $path = resource_path("posts/{$slug}.html"))) {
        //     throw new ModelNotFoundException();
        // }

        // return cache()->remember("posts.{$slug}", 5, fn() => file_get_contents($path)); 
    }
}
