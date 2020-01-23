<?php

use Illuminate\Database\Seeder;
use App\rdbtModelo;
class ModelosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        rdbtModelo::create([
          'rdbt_marca_id'=>2,
           'rdbtnombre'=>'laserJet',
           'rdbtDescripcion'=>'Impresora multifuncion',       
       ]);
         rdbtModelo::create([
          'rdbt_marca_id'=>1,
           'rdbtnombre'=>'2750',
           'rdbtDescripcion'=>'computadora de escritorio',       
       ]);
          rdbtModelo::create([
            'rdbt_marca_id'=>2,
           'rdbtnombre'=>'2020',
           'rdbtDescripcion'=>'camara web',       
       ]);
    }
}
