<?php
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts', [
        'posts' => Post::all() 
    ]);
});

// Route::get('posts/{post}', function ($id) {
//     return view('post', [
//         'post' => Post::findOrFail($id)
//     ]);
// });

// Route::get('/', function () {
    // return Post::find('my-first-post');
    // $document = YamlFrontMatter::parseFile(
    //     resource_path('posts/my-fourth-post.html')
    // );
    // ddd($document->date);
    // $files = File::files(resource_path("posts"));
    
    // $posts = [];

    // $posts = collect(File::files(resource_path("posts")))
    //     ->map(fn($file) => YamlFrontMatter::parseFile($file))
    //     ->map(fn($document) =>            
    //         new Post(
    //             $document -> title,
    //             $document -> excerpt,
    //             $document -> date,
    //             $document -> body(),
    //             $document -> slug,
    //     ));
        

    // $posts = array_map(function ($file) {
    //     $document = YamlFrontMatter::parseFile($file);
    //     return new Post(
    //         $document -> title,
    //         $document -> excerpt,
    //         $document -> date,
    //         $document -> body(),
    //         $document -> slug,
    //     );

    // }, $files);

//     return view('posts', [
//         'posts' => $posts
//     ]);
// });

Route::get('posts/{post}', function ($slug) {
    return view('post', [
       'post' => Post::findOrFail($slug)       
    ]);
});
    // -> where('post', '[A-z_\-]+');

    
    // $post = cache()->remember("posts.{$slug}", 5, fn()=>file_get_contents($path)); 
    

    
    // return view('post', ['post' => $post]); 

  
    // return $slug;
    // return view('post', [
    //     'post' => file_get_contents(__DIR__ . '/../resources/posts/my-third-post.html')
    // ]);
