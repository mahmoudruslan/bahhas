<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

class CascadingDropdownAddress extends Component
{
    public $countries,$country_id,$city_id, $expert, $cities = [];
    

    public function mount($countries, $expert)
    {
        $this->countries = $countries;
        $this->expert = $expert;
        
    }

    public function render()
    {
        if(!empty($this->country_id)) {
            $this->cities = City::where('country_id', $this->country_id)->get();
        }else{
            $this->reset(['cities']);
        }
        return view('livewire.cascading-dropdown-address', [
            'countries' => $this->countries,
            'cities' => $this->cities,
        ]);
    }
}
