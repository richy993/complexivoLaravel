<?php

use Illuminate\Database\Seeder;
use App\rdbtMarca;
class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
     rdbtMarca::create([
      
      'rdbtnombre'=>'HP',
      'rdbtDescripcion'=>'Impresora multifuncion',       
    ]);
     rdbtMarca::create([
     
       'rdbtnombre'=>'SAMSUNG',
       'rdbtDescripcion'=>'computadora de escritorio',       
     ]);
     rdbtMarca::create([
      
       'rdbtnombre'=>'LEXMARK',
       'rdbtDescripcion'=>'camara web',       
     ]);
   }
 }
