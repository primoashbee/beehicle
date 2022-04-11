<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $providers = [
            'Motortrade',
            'Toyota',
            'Hyundai',
            'Honda',
            'Mitsubishi'
        ];
        $data = [];
        $now = now();

        foreach($providers as $provider)
        {
            $data[] = [
                'name'=>$provider,
                'description'=>'',
                'created_at'=>$now

            ];
        }

        return Provider::insert($data);
    }
}
