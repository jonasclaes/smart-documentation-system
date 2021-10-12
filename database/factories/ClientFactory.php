<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'clientNumber' => $this->faker->unique()->numberBetween(1, 30),
            'name' => $this->faker->company(),
            'contactEmail' => $this->faker->unique()->companyEmail(),
            'contactPhoneNumber' => $this->faker->unique()->e164PhoneNumber(),
        ];
    }
}
