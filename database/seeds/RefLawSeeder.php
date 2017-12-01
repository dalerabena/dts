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
        if (DB::table('ref_laws')->get()->count() == 0) {
            DB::table('ref_laws')->insert([
                ['type' => 'Resolution'],
                ['type' => 'Ordinance']
            ]);
        }
    }
}
