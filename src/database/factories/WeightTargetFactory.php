<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightTarget;
use App\Models\User;

class WeightTargetFactory extends Factory
{
    // このファクトリが操作するモデルを指定
    protected $model = WeightTarget::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Seederで上書き可能
            'target_weight' => $this->faker->randomFloat(1, 55, 75),
            'target_date' => $this->faker->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
        ];
    }
}