@extends('master')

@section('content')

<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        <a href="{{ route('users.index') }}" class="navbar-brand">Lista de usuários</a>
        <form action="{{ route('users.search') }}" method="GET" class="d-flex">
            <input class="form-control me-2" name="query" type="text" placeholder="Buscar usuário" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
            <a href="{{route('users.create')}}" class="btn btn-outline-success ms-5 text-nowrap">Adicionar usuário</a>
        </form>
    </div>
</nav>

<div class="row pt-3">
    <div class="col mx-auto">
        <div class="mb-3 d-flex justify-content-end align-items-center">
            @if(session()->has('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @auth
            <h2 class="me-5 ms-5">Olá, {{$currentUser->name}}</h2>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
            @endauth

            @guest
            <a href="{{ route('login') }}" class="ms-3 btn btn-outline-primary">Faça login</a>
            @endguest

        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    @if(auth()->user()->administrador)
                    <th scope="col">Administrador</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="align-middle">{{$user->id}}</td>
                    <td class="align-middle">{{$user->name}}</td>
                    <td class="align-middle">{{$user->email}}</td>
                    <td class="align-middle cpf">{{$user->cpf}}</td>
                    <td class="align-middle telefone">{{$user->telefone}}</td>
                    @if(auth()->user()->administrador)
                    <td class="align-middle">{{ $user->administrador ? 'SIM' : 'NÃO' }}</td>
                    <td class="align-middle"><a href="{{ route('users.edit', ['user' => $user->id]) }}"
                    class="btn btn-outline-primary">Editar</a></td>
                    @endif
                    <td class="align-middle"><a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-outline-secondary">Detalhes</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center mt-5">
    {{ $users->links() }}
</div>

<!--FORMATANDO O CPF E TELEFONE-->

<script>
    $(document).ready(function() {
        $('.cpf').each(function() {
            var cpf = $(this).text();
            $(this).text(cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'));
        });

        $('.telefone').each(function() {
            var telefone = $(this).text();
            $(this).text(telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3'));
        });
    });
</script>

@endsection
