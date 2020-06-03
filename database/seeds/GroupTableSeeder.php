<?php

use Illuminate\Database\Seeder;
use App\Groups;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Groups();
        $role->name = 'SINCI';
        $role->save();
    }
}
