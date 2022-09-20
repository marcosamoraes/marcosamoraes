@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <i class="fa fa-calendar"></i> Contas
                    <a href="{{ route('accounts.create') }}" class="pull-right btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Adicionar"><i class="fa fa-plus"></i></a>
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
                                <th>Usuário</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accounts as $account)
                            <tr>
                                <td class="align-middle">
                                    {{$account->id}}
                                </td>
                                <td class="align-middle">
                                    {{$account->email}}
                                </td>
                                <td class="align-middle">
                                    @if( $account->in_use == 0 )
                                        <span class="text-primary">Aguardando</span>
                                    @elseif( $account->in_use == 1 )
                                        <span class="text-secondary">Usada</span>
                                    @elseif( $account->in_use == 2 )
                                        <span class="text-danger">Bloqueada</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <div class="row" style="padding:0; margin:0;">
                                        <div class="col-md-4" style="padding:0; margin:0;">
                                            <a href="{{ route('accounts.edit', ['account' => $account->id]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-4" style="padding:0; margin:0;">
                                            <form method="POST" action="{{ route('accounts.destroy', ['account' => $account->id]) }}" style="padding:0; margin:0;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <div class="form-group" style="padding:0; margin:0;">
                                                    <button type="submit" class="btn btn-danger btn-sm delete-account" data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>      
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    {{ $accounts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal accounts -->
<div class="modal fade" id="accounts" tabindex="-1" role="dialog" aria-labelledby="accountsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="accountsLabel">accounto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="accounts"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Search -->
<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="searchLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="accounts" type="GET">
            <div class="input-group">
                <input type="text" class="form-control q" placeholder="Digite o que deseja pesquisar..." name="q" required>
                <div class="input-group-btn">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-search"></i>
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
        $('#search').on('shown.bs.modal', function() {
            $('input:text:visible:first').focus();
        })

        $(".btn-accounts").on('click', function(){
            id = $(this).data('id');
            $.ajax({
                url: 'accounts/'+id,
                type: 'GET',
                dataType: 'html',
                success: function (html) {
                    $(".accounts").html(html);
                }
            });
        });

        $('.delete-account').click(function(e){
            e.preventDefault() // Don't post the form, unless confirmed
            Swal.fire({
                title: 'Você tem certeza?',
                text: "Não será possível revertar esta ação!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                    'Deletado!',
                    'Dado deletado com sucesso.',
                    'success'
                    );
                    $(e.target).closest('form').submit();
                }
            });
        });
    }); 

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-tooltip="tooltip"]').tooltip();
    })   
</script>
@endsection
