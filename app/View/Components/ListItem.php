<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListItem extends Component
{

    /**
     * The ListItem link.
     *
     * @var
     */
    public $to;

    /**
     * The ListItem title.
     *
     * @var
     */
    public $title;

    /**
     * The ListItem subtitle.
     *
     * @var
     */
    public $subtitle;

    /**
     * Create a new component instance.
     *
     * @param string $to
     * @param string $title
     * @param string $subtitle
     * @return void
     */
    public function __construct(string $to = "#", string $title = "", string $subtitle = "")
    {
        $this->to = $to;
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.list-item');
    }
}
