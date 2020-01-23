<?php

use Illuminate\Database\Seeder;
use App\rdbtEquipo;
class EquiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 
        rdbtEquipo::create([
          
           'rdbtnombre'=>'Impresora',
           'rdbtDescripcion'=>'Impresora multifincion',       
       ]);
         rdbtEquipo::create([
           'rdbtnombre'=>'computadora',
           'rdbtDescripcion'=>'computadora de escritorio',       
       ]);
          rdbtEquipo::create([
           'rdbtnombre'=>'camara',
           'rdbtDescripcion'=>'camara web',       
       ]);
          rdbtEquipo::create([
           'rdbtnombre'=>'cam',
           'rdbtDescripcion'=>'camara web',       
       ]);
          rdbtEquipo::create([
           'rdbtnombre'=>'Impre',
           'rdbtDescripcion'=>'Impresora multifincion',       
       ]);
         rdbtEquipo::create([
           'rdbtnombre'=>'computadorafsdfs',
           'rdbtDescripcion'=>'computadora de escritorio',       
       ]);
         
    }
}
