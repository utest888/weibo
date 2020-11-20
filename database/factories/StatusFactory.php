<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Status::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $time = time();

        return [
            //
            'user_id' => mt_rand(1, 3),
            'content' => $this->faker->text(),
            'created_at' => $time,
            'updated_at' => $time
        ];
    }
}
