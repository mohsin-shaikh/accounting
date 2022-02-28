<?php

namespace Database\Factories;

use App\Models\Entry;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{

    protected $model = Entry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'details' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['in', 'out']),
            'customer_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
