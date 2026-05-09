<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BodyHome extends Component
{
    /**
     * Create a new component instance.
     */
    public $datas;
    public $pageSlide;
    public function __construct($datas=null,$pageSlide=null)
    {
  
        $this->datas=$datas;
        $this->pageSlide=$pageSlide;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.body-home');
    }
}
