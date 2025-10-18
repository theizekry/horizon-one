<?php

namespace Modules\Dashboard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Dashboard\Models\Project;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name'           => $this->faker->unique()->word(),
            'env'            => $this->faker->randomElement(['develop', 'beta', 'uat', 'production', 'testing']),
            'redis_host'     => $this->faker->ipv4(),
            'redis_port'     => 6379,
            'redis_password' => null,
            'redis_db'       => 0,
            'horizon_prefix'  => 'horizon',
        ];
    }

    public function local(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Local Horizon',
            'env' => 'develop',
            'redis_host' => 'app.redis',
            'redis_port' => 6379,
            'redis_db' => 0,
            'horizon_prefix' => 'horizon',
        ]);
    }
}

