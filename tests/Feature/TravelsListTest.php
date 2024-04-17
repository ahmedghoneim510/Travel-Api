<?php

namespace Tests\Feature;

use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TravelsListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_travels_list_returns_paginated_data_correctly(): void
    {
        Travel::factory(30)->create(['is_public' => false]);
        $response = $this->get('/api/V1/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(15, 'data');
        $response->assertJsonPath('meta.last_page', 2);
    }
//    public function test_travels_list_shows_only_public_records(): void
//    {
//        $travel = Travel::factory(1)->create(['is_public' => true])->first();
//        Travel::factory(1)->create(['is_public' => false]);
//        $response = $this->get('/api/V1/travels');
//
//        $response->assertStatus(200);
//        $response->assertJsonCount(1, 'data');
//        $response->assertJsonPath('data.0.name', $travel->name);
//    }
}
