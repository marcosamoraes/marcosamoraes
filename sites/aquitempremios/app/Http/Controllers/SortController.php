<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Crypt;

use Rap2hpoutre\FastExcel\FastExcel;

class SortController extends Controller
{
    private function decryptHash($hash)
    {
        if (empty($hash)) return [];

        $decrypted = Crypt::decryptString($hash); // array

        $result = explode('..', $decrypted);
        $data = [
            'email'     => $result[0] ?? '',
            'password'  => $result[1] ?? '',
            'date'      => $result[2] ?? ''
        ];

        return $data['password'];
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('id','desc')->paginate();
        return view('sort.index',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sort.create');
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
            'total'                 => $request->total
        ]);

        $request->session()->flash('status', 'Post cadastrado com sucesso!');
        return redirect('/sorts');
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
        $data .= "<tr><td><b>Maior ID</b></td><td>".$post->total."</td></tr>";
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
        return view('sort.edit',['post' => $post]);
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
        $post       = Post::findOrFail($id);

        $post->update([
            'name'                  => $request->name,
            'instagram_post_code'   => $request->instagram_post_code,
            'total'                 => $request->total
        ]);

        $request->session()->flash('status', 'Post atualizado com sucesso!');
        return redirect('/sorts?update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $comments   = Comment::where('post_id', $id)->forceDelete();
        $post       = Post::findOrFail($id)->delete();

        $request->session()->flash('status', 'Post deletado com sucesso!');
        return redirect('/sorts?update&pass=124');
    }

    public function export($post_id) 
    {
        $post       = Post::findOrFail($post_id);
        set_time_limit(0);
        return (new FastExcel($this->commentsGenerator($post_id)))->download($post->instagram_post_code.'-'.$post->name.'.xlsx');
        //return (new FastExcel($this->commentsGenerator($post_id)))->download('agenciadojers_.xlsx');
    }

    private function commentsGenerator($post_id) {
        $comments = Comment::select('comment_id', 'username', 'comment_text')->where('post_id', $post_id)->cursor();
        // $comments = Comment::select('comment_id', 'username', 'comment_text')->where('post_id', '>=', '87')->where('post_id', '<=', '88')->cursor();
        foreach ($comments as $comment) {
            yield $comment;
        }
    }
}
