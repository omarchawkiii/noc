<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\255;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LocationController
 */
final class LocationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $locations = Location::factory()->count(3)->create();

        $response = $this->get(route('location.index'));

        $response->assertOk();
        $response->assertViewIs('locations.index');
        $response->assertViewHas('locations');
    }


    #[Test]
    public function show_displays_view(): void
    {
        $location = Location::factory()->create();

        $response = $this->get(route('location.show', $location));

        $response->assertOk();
        $response->assertViewIs('locations.show');
        $response->assertViewHas('location');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LocationController::class,
            'store',
            \App\Http\Requests\LocationControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $folder_title = $this->faker->word();
        $connection_ip = $this->faker->word();
        $tms_system = $this->faker->word();
        $rentrak = 255::factory()->create();
        $modem = $this->faker->word();
        $internet = $this->faker->word();
        $address = $this->faker->word();
        $city = $this->faker->city();
        $zip = $this->faker->postcode();
        $country = $this->faker->country();
        $state = $this->faker->word();

        $response = $this->post(route('location.store'), [
            'name' => $name,
            'folder_title' => $folder_title,
            'connection_ip' => $connection_ip,
            'tms_system' => $tms_system,
            'rentrak_id' => $rentrak->id,
            'modem' => $modem,
            'internet' => $internet,
            'address' => $address,
            'city' => $city,
            'zip' => $zip,
            'country' => $country,
            'state' => $state,
        ]);

        $locations = Location::query()
            ->where('name', $name)
            ->where('folder_title', $folder_title)
            ->where('connection_ip', $connection_ip)
            ->where('tms_system', $tms_system)
            ->where('rentrak_id', $rentrak->id)
            ->where('modem', $modem)
            ->where('internet', $internet)
            ->where('address', $address)
            ->where('city', $city)
            ->where('zip', $zip)
            ->where('country', $country)
            ->where('state', $state)
            ->get();
        $this->assertCount(1, $locations);
        $location = $locations->first();

        $response->assertRedirect(route('locations.index'));
    }
}
