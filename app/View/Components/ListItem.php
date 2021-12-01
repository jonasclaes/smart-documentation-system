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
     * The ListItem classes.
     *
     * @var
     */
    public $class;

    /**
     * The ListItem labels.
     *
     * @var
     */
    public $labels;

    /**
     * Create a new component instance.
     *
     * @param string $to
     * @param string $title
     * @param string $subtitle
     * @param string $class
     * @param array  $labels
     * @return void
     */
    public function __construct(string $to = "#", string $title = "", string $subtitle = "", string $class = "", array $labels = [])
    {
        $this->to = $to;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->class = $class;
        $this->labels = $labels;
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
