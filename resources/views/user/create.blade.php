@extends('master')

@section('content')

<div class="row">
    <div class="col-6 mx-auto">
        <div class="d-flex align-items-center justify-content-center mt-3">
            <h2>Cadastro</h2>
        </div>
        <form action="{{ route('users.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                @error('name')
                <div class="mt-3 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" type="text" name="email" value="{{ old('email') }}">
                @error('email')
                <div class="mt-3 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input class="form-control" id="cpf" type="text" name="cpf" value="{{ old('cpf') }}">
                @error('cpf')
                <div class="mt-3 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input class="form-control" id="telefone" type="text" name="telefone" value="{{ old('telefone') }}">
                @error('telefone')
                <div class="mt-3 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input class="form-control" type="password" name="password">
                @error('password')
                <div class="mt-3 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Confirmar senha</label>
                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                @error('password_confirmation')
                <div class="mt-3 alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <ul>
                    <li>
                        Sua senha deve ter no mínimo 8 caracteres
                    </li>
                    <li>Conter pelo menos uma letra e um número</li>
                </ul>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-lg btn-primary me-5">Enviar</button>
                <a href="{{ route('login') }}">Já possui conta?</a>
            </div>
        </form>
    </div>
</div>


@if(session()->has('message'))
<div class="row mt-3">
    <div class="col-3 mx-auto alert alert-success d-flex justify-content-center" role="alert">
        <span>{{ session('message') }}</span>
    </div>
</div>
@endif

@if(session()->has('error'))
<div class="row mt-3">
    <div class="col-3 mx-auto alert alert-danger d-flex justify-content-center" role="alert">
        <span>{{ session('error') }}</span>
    </div>
</div>

@endif

<script>
    $(document).ready(function() {
        $('#cpf').mask('000.000.000-00');
        $('#telefone').mask('(00) 00000-0000');
    });
</script>

@endsection
