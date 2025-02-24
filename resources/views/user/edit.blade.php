@extends('master')

@section('content')

<div class="row">
    <div class="col-6 mx-auto">
        <div class="d-flex justify-content-center align-items-center mt-3">
            <h1>Editar usuário</h1>
        </div>
        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input class="form-control" type="text" name="name" value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" type="text" name="email" value="{{$user->email}}">
            </div>
            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input class="form-control" type="text" name="cpf" value="{{$user->cpf}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input class="form-control" type="text" name="telefone" value="{{$user->telefone}}">
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-lg btn-primary">Enviar</button>
                <a href="{{ route('users.index') }}" class="btn btn-lg btn-secondary ms-5">Voltar</a>
            </div>
        </form>
    </div>
</div>
@if(session()->has('message'))
<div class="row mt-3 d-flex justify-content-center align-items-center">
    <div class="col-3 alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session()->get('message')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

@endif

@endsection
