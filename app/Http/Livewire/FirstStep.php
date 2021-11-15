<?php

namespace App\Http\Livewire;

use App\Http\Middleware\TrustHosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class FirstStep extends Component
{
    use WithFileUploads;

    public $name;
    public $profilpic;
    public $bannerpic;
    public $temporaryProfilImg;
    public $temporaryBannerImg;
    public $message;

    public function changeTemporaryProfilImg(): void
    {
        $this->temporaryProfilImg =
            str_replace('livewire/preview-file','storage/livewire-tmp',$this->profilpic->temporaryUrl());
    }

    public function changeTemporaryBannerImg(): void
    {
        $this->temporaryBannerImg =
            str_replace('livewire/preview-file','storage/livewire-tmp',$this->bannerpic->temporaryUrl());
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'string',
            'profilpic' => 'image|max:1024|nullable',
            'bannerpic' => 'image|max:1024|nullable'
        ]);

        if($this->name) {
            auth()->user()->update([
                'name' => $this->name,
            ]);
        }
        if ($this->profilpic) {
            $name = 'cc' . '.jpg';
            $this->profilpic->storeAs('images', $name);
            auth()->user()
                ->addMedia(storage_path('app/public/images/' . $name))
                ->toMediaCollection('users-pic');
        }
        if ($this->bannerpic) {
            $store = $this->bannerpic->store('app/public/images/users/banner-pic');
            auth()->user()->addMedia($store)->toMediaCollection('banner-pic');
        }
    }

    public function render()
    {
        if ($this->profilpic) {
            $this->changeTemporaryProfilImg();
        }
        if ($this->bannerpic) {
            $this->changeTemporaryBannerImg();
        }
        return view('livewire.first-step');
    }
}
