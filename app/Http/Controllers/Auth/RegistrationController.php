<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;

class RegistrationController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $formData = $request->validate([
            'name' => ['required', 'string', 'max:64'],
            'email' => ['required', 'string', 'email', 'max:64', 'unique:'.User::class],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'account_type' => ['required', 'string', 'in:client,freelancer'],
            'terms_and_conditions' => ['required', 'accepted'],
            'privacy_policy' => ['required', 'accepted'],
        ]);

        $formData['password'] = Hash::make($formData['password']);

        $user = User::create($formData);

        Auth::login($user);

        return redirect(route('projects.index', absolute: false));
    }
}
