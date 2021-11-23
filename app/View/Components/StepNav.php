<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StepNav extends Component
{
    public $firstStep;
    public $secondStep;
    public $thirdStep;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($firststep, $secondstep, $thirdstep)
    {
        $this->firstStep = $firststep;
        $this->secondStep = $secondstep;
        $this->thirdStep = $thirdstep;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.step-nav');
    }
}
