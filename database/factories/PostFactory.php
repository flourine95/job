<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_title' => fake('vi_VN')->jobTitle(),
            'district' => fake('vi_VN')->address(),
            'city' => fake('vi_VN')->city(),
            'remote' => fake('vi_VN')->name(),
            'is_parttime' => fake('vi_VN')->boolean(),
            'min_salary' => fake('vi_VN')->numberBetween(5_000_000, 10_000_000),
            'max_salary' => fake('vi_VN')->numberBetween(10_000_000, 50_000_000),
            'currency_salary' => fake('vi_VN')->name(),
            'requirement' => fake('vi_VN')->name(),
            'start_date' => fake('vi_VN')->name(),
            'end_date' => fake('vi_VN')->name(),
            'number_applicants' => fake('vi_VN')->name(),
            'status' => fake('vi_VN')->name(),
            'slug' => fake('vi_VN')->name(),
            'user_id' => fake('vi_VN')->name(),
            'company_id' => fake('vi_VN')->name(),
        ];
    }
}
