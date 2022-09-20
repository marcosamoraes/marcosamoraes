@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <i class="fa fa-instagram"></i> Criar Conta
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('accounts.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="username">E-mail/Username</label>
                            <input type="text" class="form-control" id="email" name="email"  placeholder="E-mail" required>
                        </div>     
                        <div class="form-group">
                            <label for="name">Senha</label>
                            <input type="password" class="form-control" id="password" name="password"  placeholder="Senha" required>
                        </div>                    
                        <a href="{{ route('accounts.index') }}" class="btn btn-danger pull-left">Voltar</a>                       
                        <button type="submit" class="btn btn-success pull-right">Criar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
