<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voted>
 */
class VotedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mission = [];
        for ($i = 0; $i < 5; $i++) {
            $mission[] = fake()->sentence();
        }
        return [
            'nim' => fake()->lexify('??/??????/SV/?????'),
            'mission' => implode("\n", $mission),
            'vision' => fake()->paragraph(),
            'name' => fake()->name(),
            'avatar' => 'https://assetsugm.id/storage/datamahasiswa/MRtx1bLSj52bnMbtOXhKA5Zh8M4535WE4ygLBJN8.jpg'
        ];
    }
}
