<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;

class ProfileEdit extends Component
{
    use WithFileUploads;

    public Collection $medias;

    public $photo;
    public string $pseudo;
    public string $name;

    public function mount()
    {
        $this->pseudo = auth()->user()->pseudo;
        $this->name = auth()->user()->name;
    }

    /**
     * @param string $url
     * @return string
     */
    public function getTemporaryRealUrl(string $url): string
    {
        return Str::replace('livewire/preview-file', 'livewire-tmp', $url);
    }

    public function refreshMedia()
    {
        $this->medias = auth()->user()
            ->load('media')
            ->media;
    }

    public function submit()
    {
        $this->validate([
            'photo' => 'nullable|max:2048',
            'pseudo' => 'required',
            'name' => 'nullable',
        ]);

        if ($this->photo) {
            auth()->user()
                ->addMedia($this->photo)
                ->toMediaCollection('profile');
        }

        auth()->user()
            ->update([
                'pseudo' => $this->pseudo,
                'name' => $this->name,
            ]);

        $this->photo = null;

        $this->redirect(request()->session()->previousUrl());
    }

    public function render()
    {
        return view('livewire.profile-edit');
    }
}
