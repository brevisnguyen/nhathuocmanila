<?php

namespace App\Livewire;

use App\Settings\WebSettings;
use Illuminate\Support\Collection;
use Livewire\Component;

class Footer extends Component
{
    public Collection $website;

    public function mount()
    {
        $this->website = (new WebSettings())->toCollection();
    }

    public function render()
    {
        return view('livewire.footer');
    }
}
