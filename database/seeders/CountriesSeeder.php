<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [

            [
                'country_code' => 'lt'
            ],
            [
                'country_code' => 'us'
            ],
            [
                'country_code' => 'de'
            ],
        ];

        Country::insert($countries);
    }
}
