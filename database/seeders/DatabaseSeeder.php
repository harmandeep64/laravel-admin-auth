<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        //$this->admin();
        $this->countries();
    }

    protected function admin() {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'country_code' => '+91',
            'phone_number' => '',
            'password' => bcrypt('123456'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function countries() {
        $json = File::get(public_path('assets/countries.json'));
        $countries = json_decode($json);

        foreach ($countries as $country) {
            Country::create([
                'name'                      => $country->name,
                'iso'                       => $country->iso,
                'flag'                      => $country->flag,
                'country_code'              => $country->country_code,
                'min_phone_number_length'   => $country->min_phone,
                'max_phone_number_length'   => $country->max_phone,
            ]);
        }
    }
}
