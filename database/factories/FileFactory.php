<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fileId' => $this->faker->unique()->numberBetween(0, 10000),
            'name' => $this->faker->text(20),
            'uniqueId' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'clientId' => $this->faker->numberBetween(1, 30)
        ];
    }
}
