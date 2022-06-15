<?php

namespace App\Http\Livewire;

use App\Models\StatusType;
use Illuminate\Support\Collection;
use Livewire\Component;

class Status extends Component
{
    public Collection $types;
    public bool $isShow = false;

    public string $message;

    public function mount()
    {
        $this->message = auth()->user()->status->message ?? '';
        $this->types = StatusType::all();
    }

    public function setIsShowToTrue()
    {
        $this->isShow = true;
    }

    public function setIsShowToFalse()
    {
        $this->isShow = false;
    }

    public function submit()
    {
        auth()->user()
            ->status()
            ->update([
                'message' => $this->message,
            ]);
    }

    public function changeStatus(int $id)
    {
        auth()->user()
            ->status()
            ->update([
                'status_type_id' => $id
            ]);

        if (!empty($this->message)) {
            auth()->user()
                ->status()
                ->update([
                    'message' => $this->message,
                ]);
        }

        $this->redirect(request()->session()->previousUrl());
    }

    public function render()
    {
        return view('livewire.status');
    }
}
