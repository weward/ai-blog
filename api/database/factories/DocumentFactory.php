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
        $numOfBullets = $this->randNumOfBullets();

        return [
            'subject' => fake()->realText(80, 2),
            'summary' => fake()->realText(200, 2),
            'bullets' => $this->createBullets($numOfBullets),
            // 'result' => fake()->realText(3600, 2),
            'result' => $this->generateResult($numOfBullets),
        ];
    }


    public function randNumOfBullets()
    {
        $min = 4;
        $max = 8;

        return rand($min, $max);
    }

    public function createBullets($numOfBullets)
    {
        $i = 0;
        $words = "";
        while($i < $numOfBullets) {
            $company = fake()->company;
            $words .= "- {$company}\\n";

            $i++;
        }

        return $words;
    }

    public function generateResult($numOfBullets)
    {
        $i = 0;
        $result = "";

        while ($i < $numOfBullets) {
            $paragraph = fake()->realText(1200, 2);
            $result .= "{$paragraph}\\n\\n";

            $i++;
        }

        return $result;
    }
}
