<?php

namespace Modules\Dashboard\Database\Factories;

use Illuminate\Support\Str;
use Modules\Dashboard\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'           => fake()->name(),
            'username'       => str_replace('.', '', fake()->userName()),
            'email'          => fake()->unique()->safeEmail(),
            'password'       => 123456,
            'is_blocked'     => false,
            'phone_number'   => '01119982221',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Mark the admin as Blocked from the system.
     */
    public function blocked(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_blocked' => true,
        ]);
    }
}
