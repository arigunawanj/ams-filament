<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $bulanIni = Carbon::now()->month;
        $carbon = Carbon::now();
        // $bulanCarbon = date_create(Carbon::now());
        $bulanEkstrak = Carbon::parse($carbon)->formatLocalized('%B');

        return view('livewire.dashboard', compact(
            'carbon',
            'bulanEkstrak',
        ));
    }
}
