<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;


class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $address_ids = Address::select('id')->get();
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail(),
            'image' => 'images/customers/customer.jpg',
            'phone' => '010' . rand('10000000', '99999999'),
            // 'password' => '00000000',
            // 'status' => true,
            // 'address_id' => $address_ids->random()->id
        ];
    }
}
