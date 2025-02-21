@extends('master')

@section('content')

<div class="row">
    <div class="col-6 mx-auto">
        <h1>Edit</h1>
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
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</div>
@if(session()->has('message'))
    <div class="row mt-3">
        <div class="col-3 alert alert-success d-flex justify-content-center" role="alert">
            <span >{{session()->get('message')}}</span>
        </div>
    </div>

@endif

@endsection
