@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <i class="fa fa-instagram"></i> Criar Post
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('sorts.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Nome do Post</label>
                            <input type="text" class="form-control" id="name" name="name"  placeholder="Nome do Post" required>
                        </div> 
                        <div class="form-group">
                            <label for="name">Código do Post</label>
                            <input type="text" class="form-control" id="instagram_post_code" name="instagram_post_code"  placeholder="Código do Post" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Total</label>
                            <input type="text" class="form-control" id="total" name="total"  placeholder="Total" required>
                        </div>
                        <a href="{{ route('sorts.index') }}" class="btn btn-danger pull-left">Voltar</a>                       
                        <button type="submit" class="btn btn-success pull-right">Criar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
