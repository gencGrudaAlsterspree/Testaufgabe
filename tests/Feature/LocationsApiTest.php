<?php

namespace Tests\Feature;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class LocationsApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function test_get_all_locations()
//    {
//        $response = $this->get('/location');
//
//        $response->assertStatus(200);
//    }

    /**
     * I would like to add more tests, but wasn't able to because of time
     * This test might fail, was having some config problem with PHPUnit
     */
    public function test_upload_json()
    {
        $file = new UploadedFile('./tests/data/locations.json', 'locations.json');
        $response = $this->postJson('location',[
            'file' => $file,
        ]);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertNoContent();

        // look into the database if model has been added
        $location = Location::where('name', 'Teltow')->first();
        $this->assertModelExists($location);
    }
}
