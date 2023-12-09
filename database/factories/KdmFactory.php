<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cpl;
use App\Models\Kdm;
use App\Models\Screen;

class KdmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kdm::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'AnnotationText' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'ContentKeysNotValidBefore' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'ContentKeysNotValidAfter' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'SubjectName' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'DeviceListDescription' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'SerialNumber' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'path_file' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'server_name' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'file_type' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'id_server' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'file_size' => $this->faker->randomFloat(2, 0, 999999.99),
            'file_progress' => $this->faker->randomFloat(2, 0, 999999.99),
            'tms_path' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'last_update' => $this->faker->dateTime(),
            'screen_id' => Screen::factory(),
            'cpl_id' => Cpl::factory(),
        ];
    }
}
