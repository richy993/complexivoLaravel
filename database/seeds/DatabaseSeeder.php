<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(UsersTableSeeder::class);
    	$this->call(EquiposTableSeeder::class);
    	$this->call(MarcasTableSeeder::class);
    	$this->call(ModelosTableSeeder::class);
    	//$this->call(SeriesTableSeeder::class);
        $this->call(EquipoMarcaSeeder::class);
    }
}
