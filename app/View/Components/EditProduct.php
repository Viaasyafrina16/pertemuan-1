<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditProduct extends Component
{
    // 1. TAMBAHKAN BARIS INI (Deklarasi property)
    public string $url;

    /**
     * Create a new component instance.
     */
    public function __construct(string $url) 
    {
        // 2. Sekarang ini akan berfungsi dengan benar
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-product');
    }
}