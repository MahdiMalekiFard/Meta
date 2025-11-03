<?php

namespace App\Livewire\Admin\Pages\Estate;

use Livewire\Component;

class PurposeSelector extends Component
{
    public $purpose  = 1;
    public $price    = 0;
    public $rent     = 0;
    public $mortgage = 0;
    
    public function render()
    {
        return view('livewire.admin.pages.estate.purpose-selector');
    }
}
