<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @property-read string $email
 * @property-read string $password
 */


class MakeLoginRequest extends FormRequest
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
            //
        ];
    }


    public function tryToLogin(): bool {
        if (
        $user = User::query()
            ->where('email', '=', $this->email)
            ->first()
        ) {

            $passwordVerified = Hash::check($this->password, $user->password);

            if($user && $passwordVerified) {
                Auth::login($user);
                return true;
            }
        }
        return false;
    }

}
