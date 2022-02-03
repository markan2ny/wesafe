<?php

use App\Station;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stations')
                    ->insert([
                        [
                            'station_name' => 'fire station',
                        ],
                        [
                            'station_name'  =>  'police station',
                        ],
                        [
                            'station_name' =>  'ambulance',
                        ],
                        [
                            'station_name' =>  'emergency'
                        ]
                    ]);
    }
}
