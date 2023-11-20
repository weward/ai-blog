<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => fake()->realText(20, 2),
            'summary' => fake()->realText(100, 2),
            'bullets' => $this->createBullets(),
            'result' => fake()->realText(500, 2),
        ];
    }

    public function createBullets()
    {
        $min = 4;
        $max = 15;
        $rand = rand($min, $max);

        $i = 0;
        $words = "";
        while($i < $rand) {
            $company = fake()->company;
            $words .= "- {$company}\\n";

            $i++;
        }

        return $words;
    }
}
