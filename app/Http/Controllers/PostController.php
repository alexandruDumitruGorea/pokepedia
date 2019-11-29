<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\User;
use App\Pokemon;
use Illuminate\Http\Request;

use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idPokemon = $request->input('idpokemon');
        if($idPokemon != null) {
            $posts = Post::where('idpokemon', $idPokemon)->paginate(4);
        } else {
            $posts = Post::paginate(4);
        }
        $comments = Comment::orderBy('id', 'desc')->get();
        $users = User::All();
        $op = $request->session()->get('op');
        $result = $request->session()->get('result');
        $error = $request->session()->get('error');
        $datos = [
            'posts' => $posts,
            'comments' => $comments,
            'users' => $users
        ];
        if(isset($result)) {
            $resultado = [
                'destroy' => [
                    0 => ['danger', 'El borrado ha fallado'],
                    1 => ['success', 'El borrado ha sido un éxito']
                ],     
                'update'  => [
                    0 => ['danger', 'El editado ha fallado'],
                    1 => ['success', 'El editado ha sido un éxito']    
                ],
                'store'   => [
                    0 => ['danger', 'El guardado ha fallado'],
                    1 => ['success', 'El guardado ha sido un éxito']
                ],
            ];
            $datos += [
                'tipo'      => $resultado[$op][$result][0],
                'mensaje'   => $resultado[$op][$result][1],
            ];
        }
        return view('postsPokemon')->with($datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pokemons = Pokemon::All();
        $datos = [
            'pokemons' => $pokemons
        ];
        return view('post.create')->with($datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $error = '';
        $input = $request->validated();
        $post = new Post($input);
        $post->iduser = \Auth::id();
        try {
            $result = $post->save();
        } catch(\Exception $e) {
            $result = false;
            $error = 'Este post ya existe.';
            return redirect(route('post.create'))->withErrors($error)->withInput();
        }
        $result = true;
        
        return redirect(route('post.index'))->with(['result' => $result, 'op' => 'store']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = Comment::orderBy('id', 'desc')->get();
        $users = User::All();
        $numcomentarios = \DB::select('SELECT count(id) as numComentarios FROM comment WHERE idpost = :idPost', ['idPost' => $post->id]);
        $datos = [
            'post' => $post,
            'comments' => $comments,
            'users' => $users,
            'numcomentarios' => $numcomentarios,
        ];
        return view('post.show')->with($datos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $pokemons = Pokemon::All();
        $datos = [
            'post' => $post,
            'pokemons' => $pokemons
        ];
        return view('post.edit')->with($datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $input = $request->validated();
        try{
            $result = $post->update($input);
        } catch(\Exception $e) {
            $error = 'Introduzca bien los datos';
            return redirect('post/' . $pokemon->id . '/edit')->withErrors($error)->withInput();
        }
        return redirect(route('post.index'))->with(['result' => $result, 'op' => 'update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try{
            $post->delete();
            $result = true;
        } catch(\Exception $e) {
            $result = false;
        }
        return redirect(route('post.index'))->with(['result' => $result, 'op' => 'destroy']);
    }
}
