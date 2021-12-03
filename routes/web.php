<?php
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\Gate;


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
    \Illuminate\Support\Facades\DB::listen(function ($query) {
        logger($query->sql, $query -> bindings);
    });
    // $post = Post::where('user_id',auth()->user()->id)->get();
    if(auth()->user()) {
            return view('posts', [
            'posts' => Post:: where('user_id',auth()->user()->id)->get()
        ]);
    }
    else {
        return view('posts', [
            'posts' => Post:: with('category')->get()
        ]);
    }
    // ddd($post);
    // ddd(GATE::allows('admin'));
    // $posts = Post::with('category')->with('user')->get();
    // ddd($posts);
    // $posts = array_map(function ($post) {
    //         return (auth()->user()->id == $post->user_id) ? $post : "";
    //     }, $posts);                  
                    
    
    
    
    // $post = $post::with('user')->get();
    // ddd($user);
    // ddd($posts);
    // return view('posts', [
    //     'posts' => Post::with('category')->get()
    //     // 'posts' => Post::all() 
    // ]);
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

Route::get('posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post
    //    'post' => Post::findOrFail($id)       
    ]);
});

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts
    ]);
});
    // -> where('post', '[A-z_\-]+');

    
    // $post = cache()->remember("posts.{$slug}", 5, fn()=>file_get_contents($path)); 
    

    
    // return view('post', ['post' => $post]); 

  
    // return $slug;
    // return view('post', [
        // Post::findOrFail($id)    // ]);
Route::get('admin/posts/create', [PostController::class, 'create']);

Route::get('admin/posts/show/{post:slug}', [PostController::class, 'show']);

Route::post('admin/posts', [PostController::class, 'store']);

Route::post('admin/posts/update/{post:slug}', [PostController::class, 'update']);

Route::delete('admin/posts/{post:slug}', [PostController::class, 'destroy']);

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store'])->middleware('isadmin');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');