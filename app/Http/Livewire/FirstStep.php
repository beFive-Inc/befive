<?php

namespace App\Http\Livewire;

use App\Http\Middleware\TrustHosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
    public $statutMessage;

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
            'name' => 'string|nullable',
            'profilpic' => 'image|max:1024|nullable',
            'bannerpic' => 'image|max:1024|nullable'
        ]);

        if($this->name) {
            auth()->user()->update([
                'name' => $this->name,
            ]);
        }
        if ($this->profilpic) {
            $name = Str::uuid() . '.' . $this->profilpic->guessExtension();
            $this->profilpic->storeAs('images', $name);
            auth()->user()
                ->addMedia(storage_path('app/public/images/' . $name))
                ->toMediaCollection('user_profile_pic');
        }
        if ($this->bannerpic) {
            $name = Str::uuid() . '.' . $this->bannerpic->guessExtension();
            $this->bannerpic->storeAs('images', $name);
            auth()->user()
                ->addMedia(storage_path('app/public/images/' . $name))
                ->toMediaCollection('user_banner_pic');
        }

        Cookie::queue('hasDoneFirstStep', true, 60 * 60 * 24 * 365 * 10);

        $this->statutMessage = __('Vos informations de profil ont bien été enregistré.');
    }

    public function redirectToSecondStep()
    {
        if (isset($this->temporaryProfilImg)) {
            Storage::delete($this->temporaryProfilImg);
        }
        if (isset($this->temporaryBannerImg)) {
            Storage::delete($this->temporaryBannerImg);
        }

        //$this->redirect(route('step.second'));
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
