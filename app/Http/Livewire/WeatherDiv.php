<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class WeatherDiv extends Component
{
    public $listeners=['CitySelected'=>'UpdateDiv'];
    public $content='<br><br><br><br><br><br>';
    public function render()
    {
        return view('livewire.weather-div',['content'=>$this->content]);
    }

    public function UpdateDiv($city)
    {
        $response = $this->getWeatherFromApi($city);
        if($response) {
            //Remove <html>, <body>,...
            $this->content = strip_tags($response,'<div><img><a><script>');
        }
        else{
            $this->content =  'External API api.openweathermap.org cannot be opened';
        }
    }
    public function getWeatherFromApi($city)
    {
        try {
            $response = Http::get(config('api.url'). config('api.api_token').'&q=' . $city['name'] );
        }
        catch (\Exception $exception )
        {

            return 'Network error or api.openweathermap.org is not available';
        }
        if($response->successful())
        {
            return $response;
        }
        return false;
    }

}
