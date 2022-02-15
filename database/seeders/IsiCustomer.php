<?php

namespace Database\Seeders;

use App\Models\Customers;
use Faker\Factory as DataPalsu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class IsiCustomer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datapalsu = DataPalsu::create('id_ID');
        $data = [];

        for ($i = 0; $i <= 10; $i++) {
            $gender = $datapalsu->randomElement(['male', 'female']);
            $data[] = [
                'email' => $datapalsu->email(),
                'first_name' => $datapalsu->firstName($gender),
                'last_name' => $datapalsu->lastName(),
                'city' => $datapalsu->city(),
                'address' => $datapalsu->address(),
                'password' => Hash::make('1234567')
            ];
        }

        (new Customers())->newQuery()->insert($data);
    }
}
