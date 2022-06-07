<?php

namespace App\Http\Livewire;

use App\Models\StatusType;
use Illuminate\Support\Collection;
use Livewire\Component;

class Status extends Component
{
    public Collection $types;

    public function mount()
    {
        $this->types = StatusType::all();
    }

    public function changeStatus(int $id)
    {
        auth()->user()
            ->status()
            ->update([
                'type_id' => $id
            ]);
    }

    public function render()
    {
        return view('livewire.status');
    }
}
