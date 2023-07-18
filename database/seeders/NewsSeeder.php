<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
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
                'title' => 'berita 1',
                'slug' => 'berita-1',
                'details' => serialize([
                    'desc' => Str::random()
                ]),
                'img' => Str::random(),
                'created_by' => 'nama orang'
            ],
            [
                'title' => 'berita 2',
                'slug' => 'berita-2',
                'details' => serialize([
                    'desc' => Str::random()
                ]),
                'img' => Str::random(),
                'created_by' => 'nama orang'
            ],
            [
                'title' => 'berita 3',
                'slug' => 'berita-3',
                'details' => serialize([
                    'desc' => Str::random()
                ]),
                'img' => Str::random(),
                'created_by' => 'nama orang'
            ],
        ];

        foreach($dummy as $key => $value){
            News::create($value);
        }
    }
}
