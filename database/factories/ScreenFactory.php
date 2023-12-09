<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Location;
use App\Models\Screen;

class ScreenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Screen::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'seat' => $this->faker->randomNumber(),
            'api_namespace' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'type' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'masking_movement' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'screen_h' => $this->faker->randomFloat(2, 0, 999999.99),
            'screen_w' => $this->faker->randomFloat(2, 0, 999999.99),
            'screen_d' => $this->faker->randomFloat(2, 0, 999999.99),
            'projector_brand' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'projector_model' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'projector_ip_lan' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'lens_model' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'installed' => $this->faker->boolean(),
            'server_brand' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'server_model' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'server_ip_lan' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'ingest_capabilities' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            '3d_brand' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            '3d_model' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'automation_brand' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'automation_model' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'automation_ip_lan' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'satelite_or_live' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'transmission_brand' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'transmission_model' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'transmission_ip_lan' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'processor_brand' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'processor_model' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'processor_ip_lan' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'audio_type' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'audio_brand' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'audio_model' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'audio_channel' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'audio_frequency' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'location_id' => Location::factory(),
        ];
    }
}
