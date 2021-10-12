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
            'clientNumber' => $this->faker->unique()->numberBetween(0, 10000),
            'name' => $this->faker->name(),
            'contactEmail' => $this->faker->unique()->safeEmail(),
            'contactPhoneNumber' => $this->faker->unique()->e164PhoneNumber(),
        ];
    }
}
