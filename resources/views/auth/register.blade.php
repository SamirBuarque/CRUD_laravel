<div>
    <h1>Register</h1>

    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif


    <form action="{{ route('register') }}" method="post">

        @csrf

        <div>
            <input type="name" name="name" placeholder="Name">
        </div>

        <br>

        <div>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        </div>

        <br>

        <div>
            <input type="password" name="password" placeholder="Password">
        </div>

        <br>

        <div>
            <input type="password" name="password_confirmation" placeholder="Confirm password">
        </div>

        <br>
        <div>
            Sua senha precisa conter no os seguinter requisitos:
            <ul>
                <li>mínimo de 8 dígitos</li>
                <li>Possuir letras, números e caracteres especiais</li>
                <li>Possuir caracteres maiúsculos e minúsculos</li>
            </ul>
        </div>
        <br>
        <button>Confirm</button>
    </form>
</div>
