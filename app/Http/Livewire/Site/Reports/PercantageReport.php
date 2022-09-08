<?php

namespace App\Http\Livewire\Site\Reports;

use Livewire\Component;

class PercantageReport extends Component
{
    public function render()
    {
        return view('livewire.site.reports.percantage-report')->extends('layouts.site.base')
        ->section('content');
    }
}
