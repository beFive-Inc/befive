<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Field extends Component
{
    public $type;
    public $id;
    public $name;
    public $notice;
    public $labeltext;
    public $placeholder;
    public $autocomplete;
    public $required;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $id, $name, $notice, $labeltext, $placeholder, $autocomplete, $required, $value = null)
    {
        $this->type = $type;
        $this->id = $id;
        $this->name = $name;
        $this->notice = $notice;
        $this->labeltext = $labeltext;
        $this->placeholder = $placeholder;
        $this->autocomplete = $autocomplete;
        $this->required = $required;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.field');
    }
}
