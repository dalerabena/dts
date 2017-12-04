<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefLawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('law_types')->get()->count() == 0) {
            DB::table('law_types')->insert([
                ['type' => 'Resolution'],
                ['type' => 'Ordinance']
            ]);
        }
    }
}
