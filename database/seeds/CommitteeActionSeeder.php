<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommitteeActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('committee_actions')->get()->count() == 0) {
            DB::table('committee_actions')->insert([
                ['desc' => 'Committee Hearing'],
                ['desc' => 'Public Hearing'],
                ['desc' => 'Budget Hearing'],
            ]);
        }
    }
}
