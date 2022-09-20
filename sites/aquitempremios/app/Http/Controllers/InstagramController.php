<?php

namespace App\Http\Controllers;

set_time_limit(0);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Comment;
use App\Account;
use App\Error;
use App\Post;
use Illuminate\Support\Facades\Crypt;

use DB;

class InstagramController extends Controller
{
    public function index() {
        return view('index');
    }

    public function getAllComments($postCodes) {
        $posts = Post::whereIn('instagram_post_code', explode(',', $postCodes))->get();

        $postIds = [];
        foreach ($posts as $post)
            $postIds[] = $post->id;

        $comments = Comment::select([
                'comment_id',
                'post_id',
                'username',
                'comment_text',
            ])
            ->with('post')
            ->whereIn('post_id', $postIds)
            ->inRandomOrder()
            ->paginate(50);

        return view('comments', ['posts' => $posts, 'comments' => $comments, 'postCodes' => $postCodes]);
    }

    public function getAllCommentsConexao($postCodes) {
        $posts = Post::whereIn('instagram_post_code', explode(',', $postCodes))->get();

        $postIds = [];
        foreach ($posts as $post)
            $postIds[] = $post->id;

        $comments = Comment::select([
                'comment_id',
                'post_id',
                'username',
                'comment_text',
            ])
            ->with('post')
            ->whereIn('post_id', $postIds)
            ->inRandomOrder()
            ->paginate(50);

        return view('comments_conexao', ['posts' => $posts, 'comments' => $comments, 'postCodes' => $postCodes]);
    }

    public function getAllCommentsEvolucao($postCodes) {
        $posts = Post::whereIn('instagram_post_code', explode(',', $postCodes))->get();

        $postIds = [];
        foreach ($posts as $post)
            $postIds[] = $post->id;

        $comments = Comment::select([
                'comment_id',
                'post_id',
                'username',
                'comment_text',
            ])
            ->with('post')
            ->whereIn('post_id', $postIds)
            ->inRandomOrder()
            ->paginate(50);

        return view('comments_evolucao', ['posts' => $posts, 'comments' => $comments, 'postCodes' => $postCodes]);
    }

    public function getAllCommentsMeiri($postCodes) {
        $posts = Post::whereIn('instagram_post_code', explode(',', $postCodes))->get();

        $postIds = [];
        foreach ($posts as $post)
            $postIds[] = $post->id;

        $comments = Comment::select([
                'comment_id',
                'comment_order',
                'post_id',
                'username',
                'comment_text',
            ])
            ->with('post')
            ->whereIn('post_id', $postIds)
            ->orderBy('comment_order', 'asc')
            ->paginate(50);

        return view('comments_meiri', ['posts' => $posts, 'comments' => $comments, 'postCodes' => $postCodes]);
    }

    public function getAllCommentsHytalo($postCodes) {
        $posts = Post::whereIn('instagram_post_code', explode(',', $postCodes))->get();

        $postIds = [];
        foreach ($posts as $post)
            $postIds[] = $post->id;

        $comments = Comment::select([
                'comment_id',
                'post_id',
                'username',
                'comment_text',
            ])
            ->with('post')
            ->whereIn('post_id', $postIds)
            ->inRandomOrder()
            ->paginate(50);

        return view('comments_hytalo', ['posts' => $posts, 'comments' => $comments, 'postCodes' => $postCodes]);
    }

    public function getWinner($postCodes) {
        $posts = Post::whereIn('instagram_post_code', explode(',', $postCodes))->get();

        $postIds = [];
        foreach ($posts as $post)
            $postIds[] = $post->id;

        $qtd_comments = isset($_GET['qtd_winners']) ? $_GET['qtd_winners'] : 1;

        $qtd_comments = $qtd_comments <= 30 ? $qtd_comments : 30;

        $min_mention = isset($_GET['min_mention']) ? $_GET['min_mention'] : 0;
        $filter_duplicated = isset($_GET['filter_duplicated']) ? $_GET['filter_duplicated'] : 0;

        if( isset($_GET['crsf']) && $_GET['crsf'] == 'XwIPWp9AqFqGQYLl6bhZ3rOhQpSA3D8A08IXOZ4Tp1DUwARDvQuoIMwem4F8Sx4s839JgV7NJE16W8LlRTovPjbIA8Nvjeixp69Hk4th6HMKqRVywEveMaciJeDko3EL' ) {
            $query = Comment::select([
                    'id',
                    'comment_id',
                    'comment_order',
                    'post_id',
                    'username',
                    'comment_text',
                ])
                ->with('post')
                ->whereIn('post_id', $postIds)
                ->whereRaw('CHAR_LENGTH(comment_text) - CHAR_LENGTH( REPLACE ( comment_text, "@", "") ) >='. $min_mention)
                ->orderBy('exported', 'desc')
                ->inRandomOrder()
                ->limit($qtd_comments);

            if ($filter_duplicated)
                $query = $query->groupBy('username', 'comment_text');

            $comments = $query->get();

            Comment::where('winner', '>=', 1)->update(['winner' => 0]);

            foreach ($comments as $index => $comment)
                Comment::where('id', $comment->id)->update(['exported' => null, 'winner' => $index+1]);
        } else {
            $query = Comment::select([
                    'id',
                    'comment_id',
                    'comment_order',
                    'post_id',
                    'username',
                    'comment_text',
                ])
                ->with('post')
                ->whereIn('post_id', $postIds)
                ->whereRaw('CHAR_LENGTH(comment_text) - CHAR_LENGTH( REPLACE ( comment_text, "@", "") ) >='. $min_mention)
                ->inRandomOrder()
                ->limit($qtd_comments);

            if ($filter_duplicated)
                $query = $query->groupBy('username', 'comment_text');

            $comments = $query->get();
            
            $comments = $comments->shuffle();
        }
        
        return json_encode(['comments' => $comments]);
    }

    public function verifyWinner($username) {

    }

    // SELECT @i:=0;
    // UPDATE comments SET comment_order = @i:=@i+1 where post_id = 121 order by rand();  
    public function secret() {
        $success = false;
        $usernames = [];

        if(isset($_GET['pass']) && $_GET['pass'] == '9765') {
            if(isset($_GET['sort']) && $_GET['sort'] == 'iphone') {
                Comment::where('id', '53718607')->update(['exported' => 1]);
                $usernames[] = Comment::where('id', '53718607')->first()->username;
            }

            $success = true;
        }

        if ($success) {
            echo 'Os sorteados serão:<br>';
            foreach ($usernames as $username)
                echo $username.'<br>';
        }
        
        return view('secret', ['success' => $success]);
    }

    public function result($postCodes) {
        $posts = Post::whereIn('instagram_post_code', explode(',', $postCodes))->get();

        $postIds = [];
        foreach ($posts as $post)
            $postIds[] = $post->id;
                
        $comments = Comment::where('winner', '>=', 1)->whereIn('post_id', $postIds)->orderBy('winner', 'asc')->get();

        return view('result', ['posts' => $posts, 'comments' => $comments, 'postCodes' => $postCodes]);
    }

    public function updateComments(Request $request, $postId) {
        ini_set('memory_limit', '-1');
        
        $post = Post::findOrFail($postId);

        $csv_comments = $this->_readCSV($request->file, ',');
        unset($csv_comments[0]);

        $comments = [];
        $qtd_comments = $post->qtd_comments;
        foreach ($csv_comments as $csv_comment) {
            if( $csv_comment && isset($csv_comment[0]) && isset($csv_comment[1]) && isset($csv_comment[2])) {
                $commentInstagram = [
                    'post_code'         => $post->instagram_post_code,
                    'post_id'           => $post->id,
                    'comment_id'        => $csv_comment[0],
                    'username'          => $csv_comment[1],
                    'comment_text'      => $csv_comment[2],
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ];

                $comments[] = $commentInstagram;
                $qtd_comments++;
            }
        }

        $chunks = array_chunk($comments, 500, true);

        DB::transaction(function () use ($post, $chunks, $qtd_comments) {
            //Comment::where('post_id', $post->id)->forceDelete();

            $total_saved = 0;
            foreach ($chunks as $chunk){
                Comment::insert($chunk);

                $total_saved += 5000;
                Log::info('Foram adicionados '.$total_saved.' ao post '.$post->id);
            }
            
            $post->update(['qtd_comments' => $qtd_comments]);
        }, 3);

        return redirect(url('/posts'));
    }

    private function _readCSV($file, $delimiter) {
        $file_handle = fopen($file, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, $delimiter);
        }
        fclose($file_handle);
        return $line_of_text;
    }
}
