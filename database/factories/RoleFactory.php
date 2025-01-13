<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
        ];
    }

    public function admin()
    {
        return $this->state([
            'name' => 'admin',
            'description' => 'Administrator role with full access',
        ]);
    }

    public function user()
    {
        return $this->state([
            'name' => 'user',
            'description' => 'Standard user role',
        ]);
    }
}
