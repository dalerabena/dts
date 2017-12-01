<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SBActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('sb_actions')->get()->count() == 0) {
            DB::table('sb_actions')->insert([
                ['action' => 'Approved'],
                ['action' => 'Disapproved'],
                ['action' => 'Laid on the table'],
                ['action' => 'Deferred'],
                ['action' => 'Endorsed'],
                ['action' => 'Valid'],
                ['action' => 'Returned'],
                ['action' => 'Returned for refinement'],
                ['action' => 'Accredited'],
                ['action' => 'Invalid']
            ]);
        }
    }
}
