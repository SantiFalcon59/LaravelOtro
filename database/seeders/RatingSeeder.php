<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->insert([
            [
                'rating_id' => 1,
                'name' => 'Apta Todo Publico',
                'abbreviation' => 'ATP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating_id' => 2,
                'name' => 'Solo Mayores de 13 años',
                'abbreviation' => 'M13',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating_id' => 3,
                'name' => 'Solo Mayores de 16 años',
                'abbreviation' => 'M16',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating_id' => 4,
                'name' => 'Solo Mayores de 18 años',
                'abbreviation' => 'M18',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
