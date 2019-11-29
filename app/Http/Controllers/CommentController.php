<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $idPost = $request->input('idpost');
        return view('comment.create')->with(['idpost' => $idPost]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $error = '';
        $input = $request->validated();
        $idPost = $request->input('idpost');
        $comment = new Comment($input);
        $comment->iduser = \Auth::id();
        $comment->idpost = $idPost;
        try {
            $result = $comment->save();
        } catch(\Exception $e) {
            $result = false;
            $error = 'Este comentario ya existe.';
            return redirect(route('comment.create'))->withErrors($error)->withInput();
        }
        
        $posts = Post::where('id', $idPost)->get();
        foreach ($posts as $pt) {
            $post = $pt;
        }
        // exit;
        $comments = Comment::orderBy('id', 'desc')->get();
        $users = User::All();
        $datos = [
            'post' => $post,
            'comments' => $comments,
            'users' => $users
        ];
        
        return redirect(url('post/' . $post->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comment.edit')->with(['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $input = $request->validated();
        try{
            $result = $comment->update($input);
        } catch(\Exception $e) {
            $error = 'Introduzca bien los datos';
            return redirect('comment/' . $comment->id . '/edit')->withErrors($error)->withInput();
        }
        return redirect(route('post.index'))->with(['result' => $result, 'op' => 'update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try{
            $comment->delete();
            $result = true;
        } catch(\Exception $e) {
            $result = false;
        }
        return redirect(route('post.index'))->with(['result' => $result, 'op' => 'destroy']);
    }
}
