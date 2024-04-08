<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::query()->pluck('id')->toArray();
        $pass = Hash::make('password');
        $user = [];
        for ($i = 0; $i <= 100000; $i++) {
            $user[] = [
                'email' => fake('vi_VN')->unique()->safeEmail(),
                'name' => fake('vi_VN')->firstName() . ' ' . fake('vi_VN')->lastName(),
                'avatar' => fake('vi_VN')->imageUrl(640, 480, fake()->boolean() ? 'male' : 'female', true, 'portrait', true),
                'password' => $pass,
                'role' => fake()->randomElement(UserRoleEnum::getValues()),
                'bio' => fake()->boolean ? fake('vi_VN')->sentence() : null,
                'phone' => fake('vi_VN')->phoneNumber(),
                'position' => fake('vi_VN')->streetAddress(),
                'gender' => fake()->boolean(),
                'city' => fake('vi_VN')->city(),
                'company_id' => $companies[array_rand($companies)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            if ($i % 1000 == 0) {
                DB::table('users')->insert($user);
                $user = [];
            }
        }
    }
}
