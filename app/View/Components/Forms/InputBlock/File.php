<?php

namespace App\View\Components\Forms\InputBlock;

class File extends InputBlock
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input-block.file');
    }
}
