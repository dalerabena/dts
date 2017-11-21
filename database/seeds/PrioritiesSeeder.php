<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('ref_priorities')->get()->count() == 0) {
            DB::table('ref_priorities')->insert([
                ['desc' => 'Normal'],
                ['desc' => 'Urgent'],
                ['desc' => 'High']
            ]);
        }
    }
}
