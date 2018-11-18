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
        $types = ['common', 'epic', 'legendary', 'rare', 'uncommon'];

        foreach ($types as $name) {
            DB::table('rarities')->insert([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
