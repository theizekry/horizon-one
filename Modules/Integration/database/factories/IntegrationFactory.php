<?php

namespace Modules\Integration\Database\Factories;

use Illuminate\Support\Str;
use Modules\Integration\Models\Integration;
use Illuminate\Database\Eloquent\Factories\Factory;

class IntegrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Integration::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name'                   => $this->faker->company,
            'status'                 => $this->faker->randomElement(['active', 'pending']),
            'passport_client_id'     => null, // Set after linking to Passport
            'passport_client_secret' => null, // Optional, can encrypt later
            'created_at'             => now(),
            'updated_at'             => now(),
        ];
    }

    public function withPassportClient(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'passport_client_id'     => rand(1, 9999), // Fake, unless linking to real oauth_clients
                'passport_client_secret' => Str::random(40),
            ];
        });
    }
}
