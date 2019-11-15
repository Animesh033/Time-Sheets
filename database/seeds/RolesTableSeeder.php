<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Role::class, 3)->create();

        $items = [            
               ['id' => 1, 'name' => 'Administrator'],
               ['id' => 2, 'name' => 'Supervisor'],
               ['id' => 3, 'name' => 'Editor'],
               ['id' => 4, 'name' => 'Auditor'],
               ['id' => 5, 'name' => 'Viewer'],
           ];

           /*
           foreach ($items as $item) {
               Role::create($item);
           }
           */
           foreach ($items as $item) {
               App\Role::updateOrCreate(['id' => $item['id']], $item);
           }
    }
}
