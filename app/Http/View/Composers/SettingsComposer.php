<?php

namespace App\Http\View\Composers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\View\View;
use App\Models\Setting;

class SettingsComposer
{
    protected $settings;

    public function __construct()
    {
        $this->settings = Setting::all()->pluck('value', 'key')->toArray();
         // Fetch state and country names based on their IDs
         $state = State::find($this->settings['state-code']);
         $country = Country::find($this->settings['country-name']);
         $city = City::find($this->settings['city']);
 
         // Add state and country names to settings array
         $this->settings['state'] = $state ? $state->name : '';
         $this->settings['country'] = $country ? $country->name : '';
         $this->settings['city'] = $city ? $city->name : '';
    }

    public function compose(View $view)
    {
        // Share the settings data with the view
        $view->with('settings', $this->settings);
    }
}
