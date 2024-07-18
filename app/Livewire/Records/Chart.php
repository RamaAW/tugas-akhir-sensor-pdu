<?php

namespace App\Livewire\Records;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Records')]

class Chart extends Component
{
    public function render()
    {
        return view('livewire.records.chart');
    }
}
