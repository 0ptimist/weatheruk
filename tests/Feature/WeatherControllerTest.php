<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 *
 */
class CustomerControllerTest extends TestCase
{
    use WithFaker;

    public function testGetExistCity()
    {
        $data = [
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];

        $response = Http::withOptions(['verify' => config('app.debug') ? false : true])
            ->post(env('APP_URL') . '/api/register', $data);

        $responseJson = $response->json();

        $data = [
            'city' => $this->faker->city,
        ];

        $this->post('api/city', $data, [
            'Authorization' => 'Bearer '.$responseJson['authorisation']['token'],
            'Accept' => 'application/json',
        ])->assertStatus(200);
    }

    public function testGetInvalidCity()
    {
        $data = [
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];

        $response = Http::withOptions(['verify' => config('app.debug') ? false : true])
            ->post(env('APP_URL') . '/api/register', $data);

        $responseJson = $response->json();

        $data = [
            'city' => '',
        ];

        $this->post('api/city', $data, [
            'Authorization' => 'Bearer '.$responseJson['authorisation']['token'],
            'Accept' => 'application/json',
        ])->assertStatus(400);
    }
}
