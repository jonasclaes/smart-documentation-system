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
     * Input custom properties.
     *
     * @var
     */
    public $customProperties;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name = "", string $placeholder = "", string $customProperties = "")
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->customProperties = $customProperties;
    }

    /**
     * @return string
     */
    public function render()
    {
        return "";
    }
}
