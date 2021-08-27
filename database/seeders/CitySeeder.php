<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = json_decode(Storage::get('cities.txt'));
        $cities = collect($cities);

        foreach ($cities as $city)
        {
            $arr[]=['id'=>null, 'name'=>$city];
        }
        $chunks = array_chunk($arr,10000);

        foreach ($chunks as $chunk) {
            DB::table('cities')->insert(
          $chunk
            );
        }
    }
}
