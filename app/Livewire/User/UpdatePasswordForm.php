<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class UpdatePasswordForm extends Component
{
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'password' => ['required', 'string', 'confirmed']
            ]);
        } catch (ValidationException $e) {
            $this->reset('password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update(['password' => $validated['password']]);

        $this->reset('password', 'password_confirmation');
        $this->dispatch('close-modal', 'change-password-modal');

        Toaster::success('Cập nhật mật khẩu thành công');
    }

    public function render()
    {
        return view('livewire.user.update-password-form');
    }
}
