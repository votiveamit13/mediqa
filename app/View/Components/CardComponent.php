<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardComponent extends Component
{
    /**
     * Create a new component instance.
     */

    public $parentHeading;
    public $childHeading;
    public $parentUrl;

    public function __construct($parentHeading, $childHeading, $parentUrl)
    {
     
        $this->parentHeading = $parentHeading;
        $this->childHeading = $childHeading;
        $this->parentUrl = $parentUrl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-component');
    }
}
