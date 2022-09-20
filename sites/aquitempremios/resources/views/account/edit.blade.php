@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <i class="fa fa-calendar"></i> Editar Conta
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('accounts.update', ['account' => $account->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">E-mail/Username</label>
                            <input type="text" class="form-control" id="email" name="email"  placeholder="E-mail" required value="{{$account->email}}">
                        </div> 
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password" name="password"  placeholder="Senha" value="{{$account->password}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-see-password" type="button"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>                        
                        <a href="{{ route('accounts.index') }}" class="btn btn-danger pull-left">Voltar</a>                       
                        <button type="submit" class="btn btn-success pull-right">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-see-password').click(function() {
            var password = $('[name="password"]');

            if( password.attr('type') == 'password' ) {
                password.attr('type', 'text');
            } else {
                password.attr('type', 'password');
            }
        });
    });
</script>
@endsection
