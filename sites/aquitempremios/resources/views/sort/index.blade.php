@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">
                    <i class="fa fa-calendar"></i> Posts
                    <a href="{{ route('sorts.create') }}" class="pull-right btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Adicionar"><i class="fa fa-plus"></i></a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            <i class="fa fa-check"></i> {{ session('status') }}
                        </div>
                    @endif

                    <table id="example1" class="table table-bordered table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imagem</th>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Total Comentários</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td class="align-middle">
                                    {{$post->id}}
                                </td>
                                <td class="align-middle">
                                    <img src="public/images/{{$post->instagram_post_code}}.jpg" height="50">
                                </td>
                                <td class="align-middle">
                                    <a target="_blank" href="https://instagram.com/p/{{$post->instagram_post_code}}">
                                        {{$post->instagram_post_code}}
                                    </a>
                                </td>
                                <td class="align-middle">
                                    {{$post->name}}
                                </td>
                                <td class="align-middle">
                                    {{ $post->qtd_comments }}
                                    @isset ($_GET['update'])
                                     / {{ $post->total }}
                                    @endisset
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('sorts.edit', ['id' => $post->id]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal" data-id="{{$post->id}}">
                                      <i class="fa fa-table"></i>
                                    </button>
                                    <a target="_blank" href="{{ route('read.comments', ['postCodes' => $post->instagram_post_code]) }}?crsf=XwIPWp9AqFqGQYLl6bhZ3rOhQpSA3D8A08IXOZ4Tp1DUwARDvQuoIMwem4F8Sx4s839JgV7NJE16W8LlRTovPjbIA8Nvjeixp69Hk4th6HMKqRVywEveMaciJeDko3EL" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Visualizar Comentários">
                                        <i class="fa fa-comments"></i>
                                    </a>
                                    @isset ($_GET['update'])
                                        <form method="POST" action="{{ route('sorts.destroy', ['id' => $post->id]) }}" style="padding:0; margin:0;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger btn-sm delete-post" data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fa fa-trash"></i></button>
                                        </form>
                                    @endisset
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Search -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="{{ url('/update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <input type="file" class="form-control" name="file" required>
                <div class="input-group-btn ml-3">
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-save"></i>
                    </button>
                </div>
            </div>
        </form>        
      </div>     
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function(){
        $('[data-target="#updateModal"]').click(function() {
            $('#updateModal form').attr('action', '{{ url('/update') }}/'+$(this).attr('data-id'));
        });
    }); 
</script>
@endsection
