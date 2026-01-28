<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Status;

class OrderStatusSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderstatus=[[
            "id"=> 1,
            "name"=> "pending",
            "status"=>1
            ],

            [
            "id"=> 2,
            "name"=> "cancel",
            "status"=>1
            ],
            
            [
            "id"=> 3,
            "name"=> "In-process",
            "status"=>1
            ]
            
            
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
            
            ];

Status::insert($orderstatus);
        //
    }
}
