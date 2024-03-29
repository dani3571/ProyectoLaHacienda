<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;
use App\Models\DetalleVentas;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //llamamos al seeder
        $this->call(RoleSeeder::class);

        //
        $this->call(UserSeeder::class);
        //

              //
       $this->call(CategoriasSeeder::class);

       $this->call(ProductosSeeder::class);

        //
        $this->call(ClientesSeeder::class);
  
        //
        $this->call(MascotasSeeder::class);
      
        $this->call(VentasSeeder::class);

        $this->call(HabitacionSeeder::class);

        $this->call(ReservacionHotelSeeder::class);

        $this->call(DiagnosticosSeeder::class);

        $this->call(VacunasSeeder::class);
    }
}
