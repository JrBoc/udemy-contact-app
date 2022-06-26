<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'website' => $this->faker->domainName(),
            'email' => $this->faker->unique()->companyEmail(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
