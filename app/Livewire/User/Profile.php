<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Profile extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.user.profile');
    }
}
