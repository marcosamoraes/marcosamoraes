@extends('layouts.app')

@section('content')
    <div class="container text-white">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-12 pb-3 text-center">
                        <h2 class="my-2">Resultado do sorteio</h2>
                    </div>
                    <div class="col-12 pb-3 text-center">
                        <div class="row justify-content-center">
                            <?php $totalComments = 0; ?>
                            @foreach($posts as $post)
                                <?php $totalComments += $post->total; ?>
                                <div class="col-6 col-md-3">
                                    <img src="/images/{{$post->instagram_post_code}}.jpg" class="w-100" style="max-height: 150px; max-width: 150px">
                                    <p class="mb-0"><a target="_blank" href="https://instagram.com/p/{{$post->instagram_post_code}}" class="text-white"><b>{{$post->name}}</b></a></p>
                                    <p class="mb-0"><a target="_blank" href="https://instagram.com/p/{{$post->instagram_post_code}}" class="text-white"><b>{{$post->instagram_post_code}}</b></a></p>
                                    <p>{{$post->total}} comentários</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 pb-3 text-center winner-content text-white p-3 mb-3" style="background-color: white!important; border-radius: 15px">
                        @php
                            $sort_date = DateTime::createFromFormat('Y-m-d H:i:s', $comments[0]->updated_at);
                            $sort_date->sub(new DateInterval('PT3H'));
                        @endphp
                        <h4 class="my-2" style="color: #c43e82!important;">Sorteio realizado {{ date_format($sort_date, 'd/m/Y H:i:s') }}</h4>
                        <h4 class="my-2" style="color: #c43e82!important;">Os vencedores são:</h4>
                        <table class="table table-sm table-striped table-light">
                            <thead>
                                <tr>
                                    <th scope="col">Influenciador</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Texto</th>
                                </tr>
                            </thead>
                            <tbody class="winners_list">
                                @foreach($comments as $comment)
                                    <tr>
                                        <td><a href="https://www.instagram.com/{{ $comment->post->name }}" target="_blank">{{ $comment->post->name }}</a></td>
                                        <td><a href="https://www.instagram.com/{{ $comment->username }}" target="_blank">{{ "@".$comment->username }}</a></td>
                                        @if( str_contains($comment->comment_text, '@') )
                                            <td>
                                                <a href="https://www.instagram.com/{{ str_replace('@', '', $comment->comment_text) }}" target="_blank">
                                                    {{ $comment->comment_text }}
                                                </a>
                                            </td>
                                        @else
                                            <td>{{ $comment->comment_text }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h4 class="my-2" style="color: #c43e82!important;">Quer patrocinar um sorteio e não sabe como?</h4>
                        <button class="btn btn-lg btn-primary" style="background-color: #c43e82!important; border-color: #c43e82!important;"><a style="color: white!important" href="#" target="_blank"><b>CLIQUE AQUI</b></a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
