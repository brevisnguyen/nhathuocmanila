<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        $user = User::create($validated);

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.auth.register')->title('Đăng ký');
    }
}
