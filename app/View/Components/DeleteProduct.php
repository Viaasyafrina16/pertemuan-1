<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteProduct extends Component
{
    // 1. WAJIB: Deklarasikan property public agar terbaca di Blade
    public string $url;

    /**
     * Create a new component instance.
     */
    public function __construct(string $url)
    {
        // 2. Masukkan nilai dari parameter ke property
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-product');
    }
}