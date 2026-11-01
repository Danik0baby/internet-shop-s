<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration form.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Register a new user and sign them in.
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create($request->safe()->only(['name', 'email', 'password']));

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('catalog')
            ->with('status', 'Аккаунт создан. Добро пожаловать в NOVA!');
    }
}
