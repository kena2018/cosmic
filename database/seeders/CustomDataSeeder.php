<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customData = [
            [
                'user_id' => 10,
                'company_name' => 'finscanner',
                'first_name' => 'John1',
                'last_name' => 'Doe1',
                'email' => 'john.doe1@example.com',
                'contect' => '123456789',
                'group' => 'Group B',
                'gstin' => 'GST1234516789',
                'payment_terms' => 'Net 35',
                'address1' => '1231 Main Street',
                'address2' => 'Apt 11',
                'country' => 'IND',
                'state' => 'Ahmedabad',
                'pin' => '90001',
                'city' => 'Los Angeles',
            ],
                // Add more data as needed
        ];

        // Insert data into database
        foreach ($customData as $data) {
            Customer::create($data);
        }
    }
}
