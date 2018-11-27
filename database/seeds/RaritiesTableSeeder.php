<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RaritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [['common', 1], ['epic', 4], ['legendary', 5], ['rare', 3], ['uncommon', 2]];

        foreach ($types as $type) {
            DB::table('rarities')->insert([
                'name' => $type[0],
                'level' => $type[1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
