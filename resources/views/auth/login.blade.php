@extends('master')

@section('content')

<div class="row">
    <div class="col-6 mx-auto">
        <div class="d-flex align-items-center justify-content-center mb-5 mt-5">
            <h1>Login</h1>
        </div>
        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" type="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="d-flex align-items-center justify-content-center mb-5">
                <button class="btn btn-lg btn-primary">Enviar</button>
                <a class="ms-5" href="{{ route('users.create') }}">Cadastre-se</a>
            </div>

        </form>

    </div>
    @if (session()->has('message'))
    <div class="row mt-3">
        <div class="col-3 mx-auto alert alert-warning d-flex justify-content-center" role="alert">
            {{session()->get('message')}}
        </div>
    </div>
    @endif
</div>

@endsection
