<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

class SearchString extends Component
{
    public $listeners = ['CitySelected' => 'hideSearch'];
    public $cities = [];
    public $search = '';
    public $enableResults = true;

    public function mount($search = '')
    {
        $this->cities = [];
        $this->search = $search;
    }


    public function render()
    {
        if ($this->search == '') {
            $this->cities = [];
        }
        if (strlen($this->search) >= 3) {
            $this->cities = $this->findCities($this->search);
        }
        return view('livewire.search-string', ['search' => $this->search]);
    }


    public function enableInput()
    {
        $this->enableResults = true;
    }


    public function clearInput()
    {
        $this->search = '';
    }

    public function findCities($search)
    {
        return City::whereRaw("name LIKE '%" . $search . "%'")->get();
    }

    public function hideSearch($city)
    {
        $this->search = $city['name'];
        $this->enableResults = false;
        $this->cities = [];

    }
}

