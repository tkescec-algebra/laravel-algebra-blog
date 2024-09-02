<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $u1 = User::with(['posts', 'roles'])->find(1);
    //$posts = $u1->posts;
    dd($u1);

    $users = User::all();
    foreach ($users as $user) {
        echo "<h1>{$user->first_name} {$user->last_name}</h1>";
        echo "<p>Num of Posts: {$user->getPosts()->count()}</p>";
    }
    dd($user->getPosts());
});
