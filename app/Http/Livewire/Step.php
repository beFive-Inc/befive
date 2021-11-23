<?php

namespace App\Http\Livewire;

use App\Models\Game;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Step extends Component
{
    use WithFileUploads;

    protected string $statusError = 'error';
    protected string $statusSucceed = 'succeed';

    public Collection $steps;
    public string $name = '';
    public $profilpic;
    public $bannerpic;
    public string $query = '';
    public $temporaryProfilImg;
    public $temporaryBannerImg;
    public Collection $stepFeedBack;
    public Collection $myGames;

    public function mount()
    {
        $this->myGames = collect();

        $this->stepFeedBack = collect([
            'message' => '',
            'status' => '',
        ]);

        $this->steps = collect([
            'first' => [
                'id' => 1,
                'show' => true,
            ],
            'second' => [
                'id' => 2,
                'show' => (bool) Cookie::get('has-done-step-1'),
            ],
            'third' => [
                'id' => 3,
                'show' => (bool) Cookie::get('has-done-step-2')
            ],
        ]);
    }

    public function validatedFieldFirstStep(): array
    {
        return $this->validate([
            'name' => ['string', 'nullable'],
            'profilpic' => ['image', 'mimes:jpeg,jpg,png,svg,bmp,webp,gif', 'max:2048', 'nullable', 'sometimes'],
            'bannerpic' => ['image', 'mimes:jpeg,jpg,png,svg,bmp,webp,gif', 'max:2048', 'nullable', 'sometimes']
        ]);
    }

    public function addGamesToArray($gameID): void
    {
        if (!$this->myGames->filter(function ($game) use ($gameID) {
            return $game['id'] === $gameID;
        })->count()) {
            $this->myGames->push(Game::find($gameID));
        } else {
            $this->myGames = $this->myGames->reject(function ($game) use ($gameID){
                return $game['id'] === $gameID;
            });
        }
    }

    public function checkGameIsInArray($gameID): bool
    {
        return (bool) $this->myGames->filter(function ($game) use ($gameID) {
            return $game['id'] === $gameID;
        })->count();
    }

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

    public function saveFirstStep(): void
    {
        $this->stepFeedBack = $this->stepFeedBack->replaceRecursive([
            'message' => __('Il y a eu une erreur de validation.'),
            'status' => $this->statusError,
        ]);

        $this->validatedFieldFirstStep();

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
                ->withResponsiveImages()
                ->toMediaCollection('user_profile_pic');
        }
        if ($this->bannerpic) {
            $name = Str::uuid() . '.' . $this->bannerpic->guessExtension();
            $this->bannerpic->storeAs('images', $name);
            auth()->user()
                ->addMedia(storage_path('app/public/images/' . $name))
                ->withResponsiveImages()
                ->toMediaCollection('user_banner_pic');
        }

        //Cookie::queue('has-done-step-1', true, 60 * 60 * 24 * 365 * 10);

        if ($this->temporaryProfilImg) {
            Storage::delete($this->temporaryProfilImg);
        }
        if ($this->temporaryBannerImg) {
            Storage::delete($this->temporaryBannerImg);
        }

        $this->steps = $this->steps->replaceRecursive([
            'second' => ['show' => true],
        ]);

        $this->stepFeedBack = $this->stepFeedBack->replaceRecursive([
            'message' => __('Vos informations de profil ont bien été enregistrées.'),
            'status' => $this->statusSucceed,
        ]);
    }

    public function saveSecondStep()
    {
        if ($this->myGames) {
            foreach ($this->myGames as $game) {
                auth()->user()->addGame($game);
            }
        }

        //Cookie::queue('has-done-step-2', true, 60 * 60 * 24 * 365 * 10);

        $this->steps = $this->steps->replaceRecursive([
            'third' => ['show' => true],
        ]);

        $this->stepFeedBack = $this->stepFeedBack->replaceRecursive([
            'message' => __('Vos informations de profil ont bien été enregistrées.'),
            'status' => $this->statusSucceed,
        ]);
    }

    public function skipAllStep()
    {
        Cookie::queue('has-done-step-1', true, 60 * 60 * 24 * 365 * 10);
        Cookie::queue('has-done-step-2', true, 60 * 60 * 24 * 365 * 10);
        Cookie::queue('has-done-step-3', true, 60 * 60 * 24 * 365 * 10);

        $this->redirect(route('homepage'));
    }

    public function render()
    {
        $countStep = $this->steps->filter(function ($step) {
            return $step['show'] === true;
        })->count();

        $totalStep = $this->steps->count();

        if ($this->profilpic) {
            $this->changeTemporaryProfilImg();
        }
        if ($this->bannerpic) {
            $this->changeTemporaryBannerImg();
        }

        if ($this->query) {
            $games = Game::where('name', 'LIKE', "%$this->query%")
                ->take(100)
                ->get();
        } else {
            $games = null;
        }

        return view('livewire.step', [
            'countStep' => $countStep,
            'totalStep' => $totalStep,
            'games' => $games,
            'mygames' => $this->myGames
        ]);
    }
}
