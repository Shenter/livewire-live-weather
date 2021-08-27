<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CommonTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cities_exist_in_db()
    {
        $this->assertNotEquals(0,DB::table('cities')->count());
    }
    public function test_index_page_works()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Enter city name');
    }

    public function test_if_config_variable_exists()
    {
        $this->assertFileExists('config/api.php');
        $this->assertNotNull(config('api.api_token'));
    }
    public function test_if_api_responds()
    {
        $response = Http::get(config('api.url'). config('api.api_token').'&q=Kazan')   ;
        $this->assertEquals(200, $response->status());
    }

}
