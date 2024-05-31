<?php

namespace App\Livewire;

use App\Settings\AssociateSettings;
use App\Settings\GeneralSettings;
use Illuminate\Support\Collection;
use Livewire\Component;

class Footer extends Component
{
    public Collection $site;
    public Collection $link;

    public function mount()
    {
        $this->site = (new GeneralSettings())->toCollection();
        $this->link = (new AssociateSettings())->toCollection();
    }

    public function render()
    {
        return view('livewire.footer');
    }
}
