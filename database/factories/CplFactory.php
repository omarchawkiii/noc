<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cpl;
use App\Models\Location;

class CplFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cpl::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'durationEdits' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'storageKind' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'name' => $this->faker->name(),
            'contentKind' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'editRate_numerator' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'editRate_denominator' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'editRateFPS' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'pictureWidth' => $this->faker->randomFloat(2, 0, 999999.99),
            'pictureHeight' => $this->faker->randomFloat(2, 0, 999999.99),
            'pictureEncodingAlgorithm' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'pictureEncryptionAlgorithm' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'soundChannelCount' => $this->faker->randomFloat(2, 0, 999999.99),
            'soundQuantizationBits' => $this->faker->randomFloat(2, 0, 999999.99),
            'soundEncodingAlgorithm' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'soundEncryptionAlgorithm' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'encryptionKeysCount' => $this->faker->randomFloat(2, 0, 999999.99),
            'framesPerEdit' => $this->faker->randomFloat(2, 0, 999999.99),
            'is3D' => $this->faker->boolean(),
            'standardCompliance' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'soundSamplingRate_numerator' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'soundSamplingRate_denominator' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'assets' => $this->faker->randomFloat(2, 0, 999999.99),
            'cplSizeInBytes' => $this->faker->randomFloat(2, 0, 999999.99),
            'packageSizeInBytes' => $this->faker->randomFloat(2, 0, 999999.99),
            'markersCount' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'playable' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'last_update' => $this->faker->dateTime(),
            'cpl_list_uuivd' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'id_auditorium' => $this->faker->randomFloat(2, 0, 999999.99),
            'id_server' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'location_id' => Location::factory(),
        ];
    }
}
