<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $message;
    public $type;
    public $alertTitle;

    /**
     * Create a new component instance.
     * @param $message
     * @param $type
     * @param $alertTitle
     * @return void
     */
    public function __construct($message, $type, $alertTitle)
    {
        $this->message = $message;
        $this->type = $type;
        $this->alertTitle = $alertTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
