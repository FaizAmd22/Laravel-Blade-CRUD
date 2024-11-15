<?php

namespace App\Http\Controllers;

use App\Mail\BlogPosted;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);
        // $view_data = [
        //     'posts' => $posts
        // ];

        // return view('posts.index', $view_data);
        // if(!Auth::check()) {
        //     return redirect('login');
        // }
        
        $posts = Post::active()->orderBy('created_at', 'desc')->get();
        $view_data = [
            'posts' => $posts,
        ];

        return view('posts.index', $view_data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(!Auth::check()) {
        //     return redirect('login');
        // }

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');

        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);

        // $new_post = [
        //     count($posts) + 1,
        //     $title,
        //     $content,
        //     date('Y-m-d H:i:s')
        // ];

        // $new_post = implode(',', $new_post);

        // array_push($posts, $new_post);
        // $posts = implode("\n", $posts);

        // Storage::write('posts.txt', $posts);
        // Check if a post with the same title already exists
        $existingPost = Post::where('title', $title)->first();

        if ($existingPost) {
            // Reload the same page with an error message and old input
            return redirect('posts/create')
                ->with('error_message', 'Judul sudah ada! Coba masukkan judul lain.')
                ->with('oldTitle', $title)
                ->with('oldContent', $content);
        }

        // Create a new post if the title is unique
        $post = Post::create([
            'title' => $title,
            'content' => $content,
        ]);

        // Send an email notification
        \Mail::to('faizhalahmad8@gmail.com')->send(new BlogPosted($post));

        // Redirect to the list of posts after successfully creating the post
        return redirect('posts')->with('success_message', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);
        // $selected_post = Array();
        // foreach($posts as $post) {
        //     $post = explode(",", $post);
        //     if($post[0] == $id) {
        //         $selected_post = $post;
        //     }
        // }

        // $view_data = [
        //     'post' => $selected_post
        // ];

        // return view('posts.show', $view_data);

        $selected_post = Post::where('id', '=', $id)->first();
        $comments = $selected_post->comments()->get();
        $total_comment = $selected_post->total_comments();
        
        $view_data = [
            'post' => $selected_post,
            'comments' => $comments,
            'total_comment' => $total_comment,
        ];
        return view('posts.show', $view_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if(!Auth::check()) {
        //     return redirect('login');
        // }

        $selected_post = Post::where('id', '=', $id)->first();
        
        $view_data = [
            'post' => $selected_post
        ];

        return view('posts.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = $request->input('title');
        $content = $request->input('content');

        Post::where('id', $id)
            ->update([
                'title' => $title,
                'content' => $content,
                'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect("posts/{$id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        
        return redirect('posts');
    }
}
