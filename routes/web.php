<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Ideas;
use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

Route::view('/', 'welcome', [
    'greeting' => 'Hello, World!',
    'name' => 'John Doe',
    'age' => 30,
    'tasks' => [
        'Learn Laravel',
        'Build a project',
        'Deploy to production',
    ],
]);

Route::view('/about', 'about');
Route::view('/contact', 'contact');

//index
Route::get('/posts', function(){
    $posts = Post::all();

    return view('posts.index', [
        'posts' => $posts,
    ]);
});

//show
Route::get('/posts/{post}', function (Post $post) {
    return view('posts.show', [
        'post' => $post,
    ]);
});

//edit
Route::get('/posts/{post}/edit', function (Post $post) {
    return view('posts.edit', [
        'post' => $post,
    ]);
}
);

//update
Route::patch('/posts/{post}', function (Post $post) {
    $post->update([
        'description' => request('description'),
        'updated_at' => now(),
    ]);

    return redirect('/posts' . '/' . $post->id);
}
);

Route::resource('books', BookController::class);

//user registration routes
Route::get('/register', [UserController::class, 'index']);
Route::get('/register/create', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store']);
Route::get('/register/show/{user}', [UserController::class, 'show']);
Route::patch('/register/update/{user}', [UserController::class, 'update']);
Route::delete('/register/delete/{user}', [UserController::class, 'destroy']);