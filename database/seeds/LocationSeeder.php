<?php

use App\Location;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i = 0; $i <= 50; $i++) {
             DB::table('locations')->insert(
                 [
                     'location' =>  Str::random(10),
                     'created_at'   => Carbon::now(),
                     'station_id'   => rand(1, 4),
                 ]
                );
        }
        
        

        // DB::table('locations')->insert([
        //     ['location' => 'Pulilan', 'created_at' => Carbon::now(),],
        //     ['location' => 'Bustos', 'created_at' => Carbon::now(),]
        // ]);
    }
}
