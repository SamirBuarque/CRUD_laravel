<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public readonly User $user;
    public readonly User|null $authenticatedUser;

    public function __construct()
    {
        $this->user = new User();
        $this->authenticatedUser = Auth::user();
    }

    public function index()
    {
        $currentUser = $this->authenticatedUser;

        $users = $this->user->where(function($qry){
            if(!auth()->user()->administrador) {
                $qry->where('administrador', 0);
            }
        })->paginate(10);

        /*
        foreach ($users as $user) {
            $user->administrador_display = $user->administrador ? 'SIM' : 'NÃO';
        }
        */
        return view('users', compact('users', 'currentUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentUser = $this->authenticatedUser;
        return view('user.create', compact('currentUser'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|unique:users,email|email',
            'cpf' => 'required',
            'telefone' => 'required|min:11',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers(),
            ],
        ], [
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.letters' => 'A senha deve ter no mínimo uma letra.',
            'password.numbers' => 'A senha deve ter no mínimo um número.',
        ]);

        // tirando a máscara do cpf e verificando no banco se já existe.
        $cpfExiste = $this->user->where('cpf', preg_replace('/\D/', '', $request->input('cpf')))->first();
        if ($cpfExiste) {
            return redirect()->route('users.create')->with('error', 'CPF já cadastrado')->withInput();
        }

        if ($validated) {
            $created = $this->user->create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'cpf' => preg_replace('/\D/', '', $request->input('cpf')), // retirando a máscara do cpf e telefone para armazenar no banco
                'telefone' => preg_replace('/\D/', '', $request->input('telefone')),
                'password' => password_hash($request->input('password'), PASSWORD_DEFAULT),
                'administrador' => $request->has('administrador'),
            ]);
        }
        if ($created) {
            return redirect()->route('users.index')->with('message', 'Cadastrado com sucesso');
        }
        return redirect()->route('users.index')->with('message', 'Erro ao cadastrar o usuário');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $currentUser = $this->authenticatedUser;
        $user->administrador_display = $user->administrador ? 'SIM' : 'NÃO';
        return view('user.userDetail', compact('user', 'currentUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updated = $this->user->where('id', $id)->update($request->except(['_token', '_method']));
        if ($updated) {
            return back()->with('message', 'Editado com sucesso.');
        }

        return redirect()->back()->with('message', 'Erro ao editar o usuário.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $currentUser = $this->authenticatedUser;
        if ($currentUser->id == $id) {
            return redirect()->route('users.show', ['user' => $id])->with('message', 'Não é possível deletar o próprio usuário logado!');
        }
        $this->user->where('id', $id)->delete();
        return redirect()->route('users.index')->with('message', 'Usuário deletado com sucesso.');
    }

    public function search(Request $request)
    {
        //return view('home');
        $currentUser = $this->authenticatedUser;

        $query = $request->input('query');

        //dd($query);

        if (empty($query)) {
            return redirect()->route('users.index');
        }

        $users = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('id', $query)
            ->paginate(10);


        foreach ($users as $user) {
            $user->administrador_display = $user->administrador ? 'SIM' : 'NÃO';
        }

        if ($users->isEmpty()) {
            return redirect()->route('users.index')->with('message', 'Nenhum usuário encontrado.');
        } else {
            return view('users', compact('users', 'currentUser'));
        }
    }
}
