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
        $group = new Groups();
        $group->name = 'SINCI';
        $group->save();
    }
}
