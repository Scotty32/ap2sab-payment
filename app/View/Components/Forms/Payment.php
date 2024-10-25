<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Payment extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $action,
        public string $designation,
        public ?string $amount,
    )
    {}

    public function getActionUrl(): string 
    {
        return route($this->action);
    }
    public function shouldDisplayAmountInput(): bool
    {
        return !!$this->amount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.payment');
    }
}