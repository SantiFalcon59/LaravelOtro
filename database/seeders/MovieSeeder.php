<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

        // Vamos a cargar algunas película, ayudándonos con el Query Builder.
        // El Query Builder es una de la 2 herramientas que Laravel nos da para la interacción
        // con la base de datos. La otra forma es "Eloquent", que vamos a ver la clase que viene.
        // Para usar el Query Builder, accedemos a la clase de DB via su namespace.
    public function run(): void
    {
        DB::table('movies')->insert([
            [
                'movie_id' => 1,
                'rating_fk' => 2,
                'title' => 'El senor de los anilllos',
                'price' => 1999,
                'release_date' => '2001-12-19',
                'synopsis' => 'Un grupo de tipitos salen de excursion para tirar en un volcan un anillo malo',
                'created_at' => now(), // now() es un helper de Laravel que retorna la fecha y hora actual
                'updated_at' => now()
            ],
            [
                'movie_id' => 2,
                'rating_fk' => 4,
                'title' => 'La Matrix',
                'price' => 1799,
                'release_date' => '1999-05-02',
                'synopsis' => 'Neo sigue al conejito blanco y se mete en flor de quilombo',
                'created_at' => now(), // now() es un helper de Laravel que retorna la fecha y hora actual
                'updated_at' => now()
            ],
            [
                'movie_id' => 3,
                'rating_fk' => 1,
                'title' => 'El Discurso del Rey',
                'price' => 1999,
                'release_date' => '2016-11-01',
                'synopsis' => 'En rey tartamudo tiene la tarea de dar un discurso para levantar la moral de su pais ante una inminente guerra',
                'created_at' => now(), // now() es un helper de Laravel que retorna la fecha y hora actual
                'updated_at' => now()
            ],
        ]);
    }
}
