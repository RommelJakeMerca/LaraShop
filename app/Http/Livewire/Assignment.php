<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RegionsModel;
use App\Models\ProvincesModel;
use App\Models\CitiesModel;

class Assignment extends Component
{
    public $selectedRegion = null;
    public $selectedProvince = null;
    public $provinces = null;

    public function render()
    {
        return view('livewire.assignment', [
            'regions' => RegionsModel::all(),
        ]);
    }

    public function updatedSelectedRegion($region_id)
    {
        $this->provinces = ProvincesModel::where('id', $region_id)->get();
    }
}
