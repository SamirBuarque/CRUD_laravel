@extends('master')

@section('content')

<div class="row">
    <div class="col-6 mx-auto">
        <div class="d-flex flex-column align-items-center">
            <h1 class="mt-5">Detalhes do usuário</h1>
            <div class="d-flex align-items-center">
                <h2 class="mt-5 mb-5">{{$user->name}}</h2>
                @if($currentUser)
                    <form class="ms-5" action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-outline-danger" type="submit">Deletar</button>
                    </form>
                @endif
            </div>
        </div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{$user->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <th scope="row">CPF</th>
                    <td class="cpf">{{$user->cpf}}</td>
                </tr>
                <tr>
                    <th scope="row">Telefone</th>
                    <td class="telefone">{{$user->telefone}}</td>
                </tr>
                <tr>
                    <th scope="row">Administrador</th>
                    <td>{{$user->administrador_display}}</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>



@if(session()->has('message'))
<div class="row mt-3">
    <div class="col-5 mx-auto alert alert-warning d-flex justify-content-center" role="alert">
        <span>{{ session('message') }}</span>
    </div>
</div>
@endif

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
