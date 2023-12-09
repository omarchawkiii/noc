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
            'folder_title' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'connection_ip' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'tms_system' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'rentrak_id' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'type' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'hostname' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'email' => $this->faker->safeEmail(),
            'password' => $this->faker->password(),
            'port' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'location_email' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'phone' => $this->faker->phoneNumber(),
            'support_email' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'modem' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'internet' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'address' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'city' => $this->faker->city(),
            'zip' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'state' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'company' => $this->faker->company(),
            'language' => $this->faker->regexify('[A-Za-z0-9]{255}'),
        ];
    }
}
