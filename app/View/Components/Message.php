<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Message extends Component
{
    public $message;
    public bool $isSettings;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message, bool $isSettings = false)
    {
        $this->message = $message;
        $this->isSettings = $isSettings;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.message');
    }
}
