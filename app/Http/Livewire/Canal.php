<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Canal extends Component
{
    public $chatroom;

    public $listeners = [
        "messageSent" => '$refresh'
    ];

    public function render()
    {
        return view('livewire.canal');
    }
}
