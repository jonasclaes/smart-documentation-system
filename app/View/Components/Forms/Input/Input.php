<?php

namespace App\View\Components\Forms\Input;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Input name.
     *
     * @var
     */
    public $name;

    /**
     * Input placeholder text.
     *
     * @var
     */
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "", $placeholder = "")
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
    }

    /**
     * @return string
     */
    public function render()
    {
        return "";
    }
}
