<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post as ModelPost;

class Post extends Controller
{
    public function index() {
        return view('posts/list', ['posts' => ModelPost::all()]);
    }

    public function create() {
        return view('posts/new');
    }

    public function store(Request $request) {
        $user = $request->user();
        $pmodel = new ModelPost();
        $data = $request->all();
        $pmodel->title = $data['title'];
        $pmodel->content = $data['content'];
        $pmodel->user()->associate($user);
        $pmodel->save();
        return redirect()->route('posts');
    }

    public function show($id) {
        $post = ModelPost::query()->findOrFail($id);
        $comments = Comment::query()->where('post_id', $id)->get();
        return view('posts/post', ['post' => $post, 'comments' => $comments]);
    }

    public function edit($id) {
        $post = ModelPost::query()->findOrFail($id);
        return view('posts/edit', ['post' => $post]);
    }

    public function update(Request $request, $id) {
        $post = ModelPost::query()->findOrFail($id);
        $data = $request->all();
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->save();
        return redirect()->route('showPost', ['id'=> $id, 'post' => $post]);
    }

    public function destroy($id) {
        $post = ModelPost::query()->findOrFail($id);
        $post->delete();
        return redirect()->route('posts');
    }

    public function addComment(Request $request, $id) {
        $post = ModelPost::query()->findOrFail($id);
        $user = $request->user();
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->user()->associate($user);
        $comment->post()->associate($post);
        if (array_key_exists('name', $data)) {
            $comment->name = $data['name'];
        } else {
            $comment->name = $comment->user()->name;
        }
        $comment->save();
        return redirect()->route('showPost', ['id'=> $id, 'post' => $post]);
    }

    public function deleteComment(Request $request, $id) {
        $comment = Comment::query()->findOrFail($id);
        $postId = $comment->post->id;
        $post = ModelPost::query()->findOrFail($postId);
        $comment->delete();
        return redirect()->route('showPost', ['id'=> $postId, 'post' => $post]);
    }
}
