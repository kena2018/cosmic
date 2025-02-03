<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Outer;
use Illuminate\Support\Facades\DB;

class OuterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $outerData = [
            ['name' => 'material', 'status' => true],
            ['name' => 'row', 'status' => true],
            ['name' => 'packing', 'status' => true],
            ['name' => 'miscellaneous', 'status' => true],
        ];
        // DB::table('outers')->insert($outerData);
        foreach ($outerData as $data) {
            Outer::create($data);
        }
        
    }
}

 