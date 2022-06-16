<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Message extends Component
{
    public $message;
    public bool $isSettings;
    public bool $isRelatedMessage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message, bool $isSettings = false, bool $isRelatedMessage = true)
    {
        $this->message = $message;
        $this->isSettings = $isSettings;
        $this->isRelatedMessage = $isRelatedMessage;
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
