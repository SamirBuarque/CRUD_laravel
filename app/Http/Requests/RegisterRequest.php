<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

/**
 * @property-read string $name
 * @property-read string $email
 * @property-read string $password
 */


class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function tryToRegister() {
/*
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->save();
        */

        // posso criar usuarios dessa maneira, contanto que em Models/User.php, o campo fillable esteja preenchido com os campos definidos.
        $user = User::query()->create($this->validated());


        Auth::login($user);
        return true;

    }
}
