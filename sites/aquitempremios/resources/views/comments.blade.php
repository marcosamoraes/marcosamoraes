@extends('layouts.app')

@section('content')
    <div class="container text-white">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-12 pb-3 text-center">
                        <div class="row justify-content-center">
                            <?php $totalComments = 0; ?>
                            @foreach($posts as $post)
                                <?php $totalComments += $post->total; ?>
                                <div class="col-6 col-md-3">
                                    <img src="/sites/aquitempremios/public/images/{{$post->instagram_post_code}}.jpg" class="w-100" style="max-height: 150px; max-width: 150px">
                                    <p class="mb-0"><a target="_blank" href="https://instagram.com/p/{{$post->instagram_post_code}}" class="text-white"><b>{{$post->name}}</b></a></p>
                                    <p class="mb-0"><a target="_blank" href="https://instagram.com/p/{{$post->instagram_post_code}}" class="text-white"><b>{{$post->instagram_post_code}}</b></a></p>
                                    <p>{{$post->total}} comentários</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 pb-3 text-center">
                        <h4>Total de comentários: {{ number_format($totalComments, 0, ',', '.') }}</h4>
                    </div>
                    {{-- <div class="col-12 pb-3 text-center">
                        <div class="card text-white" style="background-color: white; color: #c43e82!important; border-radius: 15px">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="qtd_winners"><b>Nº de Ganhadores (Max: 30)</b></label>
                                            <input type="number" value="1" min="1" max="30" class="form-control" id="qtd_winners" name="qtd_winners" placeholder="Nº de Ganhadores" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="min_mention"><b>Mínimo de Menções</b></label>
                                            <input type="number" value="0" min="0" max="30" class="form-control" id="min_mention" name="min_mention" placeholder="Mínimo de Menções">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="filter_duplicated"><b>Filtrar Duplicados</b></label>
                                            <select name="filter_duplicated" id="filter_duplicated" class="form-control">
                                                <option value="0" selected>Não</option>
                                                <option value="1">Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="regress_count"><b>Contagem Regressiva</b></label>
                                            <input type="number" value="0" min="0" max="30" class="form-control" id="regress_count" name="regress_count" placeholder="Contagem Regressiva">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-lg btn-primary btn-sort" style="background-color: #c43e82!important; border-color: #c43e82!important; color: white!important"><b>Sortear</b></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pb-3 text-center d-none winner-content text-white p-3 mb-3" style="background-color: white!important; border-radius: 15px">
                        <h4 class="my-2" style="color: #c43e82!important;">Os vencedores são:</h4>
                        <table class="table table-sm table-striped table-light">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Influenciador</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Texto</th>
                                </tr>
                            </thead>
                            <tbody class="winners_list">
                            </tbody>                         
                        </table>
                        <button class="btn btn-lg btn-primary" style="background-color: #c43e82!important; border-color: #c43e82!important;"><a style="color: white!important" href="{{ route('result.comments', ['postCodes' => $postCodes]) }}" target="_blank"><b>Exportar resultado</b></a></button>
                    </div> --}}
                    <div class="col-12" style="background-color: white!important">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Influenciador</th>
                                        <th scope="col">Usuário</th>
                                        <th scope="col">Comentário</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                            {{ $comments->appends(request()->input())->links() }}         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.btn-sort').click(function() {
                var btn = $(this);
                var qtd_winners = $('[name="qtd_winners"]').val();
                var min_mention = $('[name="min_mention"]').val();
                var filter_duplicated = $('[name="filter_duplicated"]').val();
                var regress_count = $('[name="regress_count"]').val();

                btn.attr('disabled', true);
                $('.winner-content').addClass('d-none');

                if (regress_count > 0) {
                    var count = regress_count;
                    for (var i = 0; i <= regress_count; i++) {
                        setTimeout(function() {
                            btn.html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span style="font-size:30px">'+count+'</span>');

                            if (count == 0) {
                                btn.html('Sorteando...');
                            }

                            count--;
                        }, (regress_count - i) * 1000);
                    }
                } else {
                    btn.html('<i class="fa fa-spinner fa-spin fa-fw"></i>Sorteando...');
                }
                
                var crsf = '{{ isset($_GET['crsf']) ? $_GET['crsf'] : false }}';
                var params = '&qtd_winners='+qtd_winners+
                    '&min_mention='+min_mention+
                    '&filter_duplicated='+filter_duplicated;

                $.get('{{url("/sortear/$postCodes")}}?crsf='+crsf+params, function(response) {
                    var response = JSON.parse(response);
                    var comments = response.comments;
                    var html = '';
                    var i = 1;
                    $.each(comments, function(index, comment) {
                        html += '<tr>';

                        if( comment.comment_order ) {
                            var page = comment.comment_order > 50 ? parseInt((comment.comment_order / 50) + 1) : 1; 
                            var url = updateURLParameter(window.location.href, 'page', page);
                            html += '<td>'+
                                        '<a href="'+url+'" target="_blank">'+
                                            comment.comment_order+
                                        '</a>'+
                                    '</td>';
                        } else {
                            html += '<td>'+i+'</td>';
                        }

                        html += '<td>'+
                                    '<a href="https://www.instagram.com/'+comment.post.name+'" target="_blank">'+
                                        comment.post.name+
                                    '</a>'+
                                '</td>';

                        html += '<td>'+
                                    '<a href="https://www.instagram.com/'+comment.username+'" target="_blank">'+
                                        '@'+comment.username+
                                    '</a>'+
                                '</td>';

                        if( comment.comment_text.includes("@") ) {
                            var text = comment.comment_text.substring(1);
                            html += 
                                '<td>'+
                                    '<a href="https://www.instagram.com/'+text+'" target="_blank">'+
                                        comment.comment_text+
                                    '</a>'+
                                '</td>';
                        } else {
                            html += '<td>'+comment.comment_text+'</td>';
                        }

                        html += '</tr>';

                        i++;
                    });

                    $('.winners_list').html(html);
                    
                    if (regress_count > 0) {
                        if( btn.html() == 'Sorteando...') {
                            $('.winner-content').removeClass('d-none');
                            btn.html('Sortear').removeAttr('disabled');
                        } else {
                            setTimeout(function() {
                                $('.winner-content').removeClass('d-none');
                                btn.html('Sortear').removeAttr('disabled');
                            }, regress_count * 1000);
                        }
                    } else {
                        $('.winner-content').removeClass('d-none');
                        btn.html('Sortear').removeAttr('disabled');
                    }
                });
            });
        });

        function updateURLParameter(url, param, paramVal){
            var newAdditionalURL = "";
            var tempArray = url.split("?");
            var baseURL = tempArray[0];
            var additionalURL = tempArray[1];
            var temp = "";
            if (additionalURL) {
                tempArray = additionalURL.split("&");
                for (var i=0; i<tempArray.length; i++){
                    if(tempArray[i].split('=')[0] != param){
                        newAdditionalURL += temp + tempArray[i];
                        temp = "&";
                    }
                }
            }

            var rows_txt = temp + "" + param + "=" + paramVal;
            return baseURL + "?" + newAdditionalURL + rows_txt;
        }
    </script>
@endsection
