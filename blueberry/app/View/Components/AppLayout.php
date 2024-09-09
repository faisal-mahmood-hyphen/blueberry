<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public $active;
    public $breadCrumbs;
    /**
     * Get the view / contents that represents the component.
     */
    public function __construct($active = null, $breadCrumbs = [])
    {
        $this->active = $active;
        $this->breadCrumbs = $breadCrumbs;
    }
    public function render(): View
    {
        return view('layouts.app')->with(['active'=>$this->active,'breadCrumb'=>$this->breadCrumbs]);
    }
}
