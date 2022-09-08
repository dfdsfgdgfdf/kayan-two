<?php

namespace App\Http\Livewire\Site\Reports;

use Livewire\Component;

class NumbersReport extends Component
{
    public function render()
    {
        return view('livewire.site.reports.numbers-report')->extends('layouts.site.base')
        ->section('content');
    }
}
