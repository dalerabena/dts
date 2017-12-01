<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('co_authors')->get()->count() == 0) {
            DB::table('co_authors')->insert([
                ['name' => 'Committee of the Whole'],
                ['name' => 'SBM Philip S. Mandac'],
                ['name' => 'SBM Nestor B. Bringas'],
                ['name' => 'SBM Marianito P. Foronda'],
                ['name' => 'SBM Quezon B. Alejandrro'],
                ['name' => 'SBM Salustiano L. Aquino III'],
                ['name' => 'SBM Jesus E. Lagasca'],
                ['name' => 'SBM Romulo E. Hilario'],
                ['name' => 'SBM Marvin A. Crisostomo'],
                ['name' => 'SBM Rogelio G. Antonio'],
                ['name' => 'SBM Princess Ann G. Barroga'],
                ['name' => 'VM  Generoso L. Aquino, Jr.'],
                ['name' => 'SBM Zaida Hershey S. Mandac'],
                ['name' => 'SBM Lendell M. Chua'],
                ['name' => 'SBM Onofre A. Bayag'],
                ['name' => 'SBM Wilbor A. Bringas'],
                ['name' => 'SBM Rey M. Nicolas']
            ]);
        }
    }
}
