<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $countries = Country::has('cities')->select('id')->get();
        return [
            'address' => 'test',
            'country_id' => $country_id = $countries->random()->id,
            'city_id' => City::select('id', 'country_id')->where('country_id', $country_id)->first()->id
        ];
    }
}
