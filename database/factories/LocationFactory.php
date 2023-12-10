<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Location;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'folder_title' => $this->faker->name(),
            'connection_ip' => $this->faker->name(),
            'tms_system' => $this->faker->name(),
            'rentrak_id' => $this->faker->name(),
            'type' => $this->faker->name(),
            'hostname' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => $this->faker->password(),
            'port' => $this->faker->name(),
            'location_email' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'support_email' => $this->faker->name(),
            'modem' => $this->faker->name(),
            'internet' => $this->faker->name(),
            'address' => $this->faker->name(),
            'city' => $this->faker->city(),
            'zip' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'state' => $this->faker->name(),
            'company' => $this->faker->company(),
            'language' => $this->faker->name(),
        ];
    }
}
