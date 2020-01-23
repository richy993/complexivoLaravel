<?php

use Illuminate\Database\Seeder;
use App\rdbtEquipoMarca;
class EquipoMarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        rdbtEquipoMarca::create([
        	 'rdbt_equipo_id'=>2,    
            'rdbt_marca_id'=>2,       
            'rdbt_modelo_id'=>1,
            'rdbtserie'=>123456,    
            'client_id'=>3,  
        ]);
    }
}
