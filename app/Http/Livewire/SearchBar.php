<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchBar extends Component
{
    public $playerSearch;
    public $users;

    public  function  searchPlayer($string)
    {
        $this->users = DB::table("users")->where("pseudo", "Like", $string."%")->get()->pluck('pseudo');
        return $this->users;
    }
    public function render()
    {
        return view('livewire.search-bar');
    }
}
