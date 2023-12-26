<?php

namespace App\Livewire;

use App\Models\Medication as Medicine;
use Livewire\Component;

class Medication extends Component
{
    public Medicine $medicine;
    public $relates;

    public function mount(Medicine $medicine)
    {
        $this->medicine = $medicine;
        $this->relates = $this->getRelateMedicines();
    }

    protected function getRelateMedicines()
    {
        $data = collect([]);
        try {
            $query = Medicine::query();
            $cat_ids = $this->medicine->categories->pluck('id')->toArray();
            $query = Medicine::whereHas('categories', function ($query) use ($cat_ids) {
                return $query->whereIn('category_id', $cat_ids);
            });
            $data = $query->get();
        } catch (\Throwable $th) {
        }
        return $data;
    }

    public function render()
    {
        return view('livewire.medication');
    }
}
