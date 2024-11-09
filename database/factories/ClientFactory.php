<?php

namespace Database\Factories;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('112233'), // Default password for testing
            'phone' => $this->faker->unique()->numerify('###########'), // Generate a random 11-digit number
            'd_o_b' => $this->faker->date('Y-m-d', '2000-01-01'), // Birth date before 2000
            'blood_type_id' => $this->faker->numberBetween(1, 8), // Assuming there are 4 blood types
            'city_id' => $this->faker->numberBetween(1, 2), // Assuming you have 10 cities
           // 'fcm_token' => $this->faker->regexify('[A-Za-z0-9]{64}'), // Fake FCM token
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
