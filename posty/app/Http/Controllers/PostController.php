<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //le with est pour le eager loading et eviter les queries redondantes, timer 1h47 de la video
        //$posts = Post::get(); 
        //$posts = Post::orderBy('created_at','desc' )->with(['user','likes'])->paginate(5); 
        $posts = Post::latest()->with(['user','likes'])->paginate(5); 

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'body' => 'required'
        ]);

        // $request->user()->posts()->create([
        //     'body' => $request->body
        // ]);
        $request->user()->posts()->create($request->only('body'));

        return back();
    }

    public function destroy(Post $post)
    {
        if (!$post->ownedBy(auth()->user())){
            dd('no')
        }

        $post->delete();

        return back();
    }
}
