<?php

use App\Barangay;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       for($i = 0; $i <= 50 ; $i++) {

            DB::table('barangays')
                    ->insert([
                        'barangay' => Str::random(10),
                        'complete_address' => Str::random(10),
                        'mobile'    =>  rand(1000, 99),
                        'location_id'   => rand(1, 50),
                    ]);
       }
    }
}
