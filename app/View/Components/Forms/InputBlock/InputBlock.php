<?php

namespace App\View\Components\Forms\InputBlock;

use App\View\Components\Forms\Input\Input;

class InputBlock extends Input
{
    /**
     * Input label.
     *
     * @var
     */
    public $label;

    /**
     * Input help text.
     *
     * @var
     */
    public $helpText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name = "", string $placeholder = "", string $customProperties = "", string $label = "", string $helpText = "")
    {
        parent::__construct($name, $placeholder, $customProperties);

        $this->label = $label;
        $this->helpText = $helpText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return string
     */
    public function render()
    {
        return "";
    }
}
