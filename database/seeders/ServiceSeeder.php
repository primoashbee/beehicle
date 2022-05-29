<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $services = [
        //     'Oil Filter',
        //     'Air',
        //     'Gas',
        //     'Battery',
        //     'Engine',
        //     'Water',
        //     'Oil',
        //     'Belts'
        // ];
        $services  = [
            'Air',
            'Tire Replacement',
            'Scratch',
            'Seat Cover',
            'Light'
        ];
        $data = [];
        $now = now();
        foreach($services as $service)
        {
            $data[] = [
                'name'=>$service,
                'description'=>'',
                'created_at'=>$now
            ];
        }

        return Service::insert($data);
    }
}
