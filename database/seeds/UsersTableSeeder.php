<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       User::create([
           'rdbtnombre'=>'richy',
           'rdbtapellido'=>'balarezo',
           'rdbtcedula'=>'1725322182',
           'rdbttelefono'=>'0983904155',
           'rdbtdirreccion'=>'la bota',
           'email'=>'richdeivid993@gmail.com',
           'password'=>bcrypt('deivid348'),
           'rdbtrol'=>0
       ]);
        //  Soporte
       User::create([
           'rdbtnombre'=>'david',
           'rdbtapellido'=>'balarezo',
           'rdbtcedula'=>'1725563782',
           'rdbttelefono'=>'3595345',
           'rdbtdirreccion'=>'la mariscal',
           'email'=>'richdeivid93@hotmail.com',
           'password'=>bcrypt('123'),
           'rdbtrol'=>1
       ]);
        // cliente
       User::create([
           'rdbtnombre'=>'elizabeth',
           'rdbtapellido'=>'tufiño',
           'rdbtcedula'=>'1710745199',
           'rdbttelefono'=>'0985537692',
           'rdbtdirreccion'=>'el recreo',
           'email'=>'eliza.beth1967@hotmail.com',
           'password'=>bcrypt('1234'),
           'rdbtrol'=>2
       ]);
   }
}
