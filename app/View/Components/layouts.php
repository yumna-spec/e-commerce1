<?php

namespace App\View\Components;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class layouts extends Component
{
    /**
     * Create a new component instance.
     */

    public $uderid;

    public function __construct()
    {
        $this->uderid = Auth::user();

        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts');
    }
}
