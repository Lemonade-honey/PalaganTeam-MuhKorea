<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dummy = [
            [
                'title' => 'Activity 1',
                'tanggal' => date('Y-m-d', strtotime('19-07-2023')),
                'details' => serialize([
                    'time' => [
                        'start' => '12:00',
                        'end' => '13:00'
                    ],
                    'desc' => 'ini deskripsi',
                    'link' => [
                        'link link 1' => 'link 1',
                        'link link 2' => 'link 2',
                    ]
                ],)
            ],
            [
                'title' => 'Activity 2',
                'tanggal' => date('Y-m-d', strtotime('25-07-2023')),
                'details' => serialize(
                    [
                        'time' => [
                            'start' => '12:00',
                            'end' => '13:00'
                        ],
                        'desc' => 'ini deskripsi',
                        'link' => [
                            'link link 1' => 'link 1',
                            'link link 2' => 'link 2',
                        ]
                    ],
                )
            ],
            [
                'title' => 'Activity 3',
                'tanggal' => date('Y-m-d', strtotime('23-07-2023')),
                'details' => serialize(
                    [
                        'time' => [
                            'start' => '12:00',
                            'end' => '13:00'
                        ],
                        'desc' => 'ini deskripsi',
                        'link' => [
                            'link link 1' => 'link 1',
                            'link link 2' => 'link 2',
                        ]
                    ],
                )
            ],

        ];

        foreach($dummy as $key => $value){
            Activity::create($value);
        }
    }
}
