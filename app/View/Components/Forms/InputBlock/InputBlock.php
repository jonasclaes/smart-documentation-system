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
     * Input id.
     *
     * @var
     */
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name = "", string $placeholder = "", string $customProperties = "", string $label = "", string $helpText = "", string $id = "")
    {
        parent::__construct($name, $placeholder, $customProperties, $id);

        $this->label = $label;
        $this->helpText = $helpText;
        $this->id = $id;
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
