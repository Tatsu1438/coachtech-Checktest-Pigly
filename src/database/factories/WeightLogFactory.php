<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightLog;
use App\Models\User;

class WeightLogFactory extends Factory
{
    // このファクトリが操作するモデル
    protected $model = WeightLog::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Seederで上書き可能
            'date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 50, 90),
            'calories' => $this->faker->numberBetween(1500, 3000),
            'exercise_time' => $this->faker->time('H:i:s'),
            'exercise_content' => $this->faker->sentence(),
        ];
    }
}