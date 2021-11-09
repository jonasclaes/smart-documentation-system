<?php

namespace App\View\Components;

use App\Models\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FilesList extends Component
{
    /**
     * @var File[]|Collection
     */
    public $files;

    /**
     * Create a new component instance.
     *
     * @param $files File[]|Collection
     * @return void
     */
    public function __construct($files)
    {
        $this->files = $files;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.files-list');
    }
}
