<?php

namespace Database\Factories;

use App\Models\Revision;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RevisionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Revision::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'revisionNumber' => $this->faker->numberBetween(1, 100),
            'fileId' => $this->faker->numberBetween(1, 100)
        ];
    }
}
