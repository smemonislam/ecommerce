<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class inputError extends Component
{
    public $messages;
    /**
     * Create a new component instance.
     */
    public function __construct( $messages = null )
    { 
        $this->messages = $messages;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input-error');
    }
}
