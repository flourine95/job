<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake('vi_VN')->company(),
            'address' => fake('vi_VN')->streetAddress(),
            'address2' => fake('vi_VN')->streetAddress(),
            'district' => fake('vi_VN')->districtName(),
            'city' => fake('vi_VN')->city(),
            'country' => 'Việt Nam',
            'zipcode' => fake('vi_VN')->postcode(),
            'phone' => fake('vi_VN')->phoneNumber(),
            'email' => fake('vi_VN')->companyEmail(),
            'logo' => fake('vi_VN')->imageUrl(640, 480, 'company', true, 'it', true),
        ];
    }
}
