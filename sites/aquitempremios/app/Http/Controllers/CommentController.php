<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class CommentController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->q) AND $request->q != ""){
            $query = Post::query();        
            $columns = Schema::getColumnListing('posts');
            
            foreach($columns as $column)
            {
                $query->orWhere($column, 'LIKE', '%'.$request->q.'%');
            }

            $posts = $query->orderBy('id','DESC')->paginate();
            return view('post.index',['posts' => $posts]);
        }
        
        $posts = Post::orderBy('id','desc')->paginate();
        return view('post.index',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        Post::create([
            'name'                  => $request->name,
            'instagram_post_code'   => $request->instagram_post_code,
            'sleep_time'            => $request->sleep_time,
            'count'                 => $request->count,
            'max_id'                => $request->max_id,
            'paginateInd'           => $request->paginateInd,
        ]);

        $request->session()->flash('status', 'Post cadastrado com sucesso!');
        return redirect()->to(route('posts.index'));
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $data = "<table class='table table-bordered table-striped table-hover' width='100%'>";
        $data .= "<tr><td><b>Post</b></td><td>".$post->name."</td></tr>";
        $data .= "<tr><td><b>Code</b></td><td>".$post->instagram_post_code."</td></tr>";
        $data .= "<tr><td><b>Pausa</b></td><td>".$post->sleep_time."</td></tr>";
        $data .= "<tr><td><b>Quantidade</b></td><td>".$post->count."</td></tr>";
        $data .= "<tr><td><b>Maior ID</b></td><td>".$post->max_id."</td></tr>";
        $data .= "<tr><td><b>Paginação</b></td><td>".$post->paginateInd."</td></tr>";
        $data .= "<tr><td><b>Criado</b></td><td>".$post->created_at->format('d/m/Y H:i:s')."</td></tr>";
        $data .= "</table>";

        return $data;
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit',['post' => $post]);
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
        $post = Post::findOrFail($id);
        
        $username = $request->username;
        $password = $request->password;

        $post->update([
            'name'                  => $request->name,
            'instagram_post_code'   => $request->instagram_post_code,
            'sleep_time'            => $request->sleep_time,
            'count'                 => $request->count,
            'max_id'                => $request->max_id,
            'paginateInd'           => $request->paginateInd,
        ]);

        $request->session()->flash('status', 'Post atualizadao com sucesso!');
        return redirect()->to(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        $request->session()->flash('status', 'Post deletado com sucesso!');
        return redirect()->to(route('posts.index'));
    }
}
