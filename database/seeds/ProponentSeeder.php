<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('proponents')->get()->count() == 0) {
            DB::table('proponents')->insert([
                ['name' => 'Committee of the Whole'],
                ['name' => 'SBM Quezon B. Alejandrro'],
                ['name' => 'SBM Philip S. Mandac'],
                ['name' => 'SBM Marvin A. Crisostomo'],
                ['name' => 'SBM Salustiano L. Aquino'],
                ['name' => 'SBM Guillermo A. Asis'],
                ['name' => 'SBM Rey M. Nicolas'],
                ['name' => 'SBM Jesus E. Lagasca'],
                ['name' => 'SBM Nestor B. Bringas'],
                ['name' => 'ABC Pres. Rogelio G. Antonio'],
                ['name' => 'SK Pres. Princess Ann G. Barroga'],
                ['name' => 'Vice Mayor Onofre A. Bayag'],
                ['name' => 'SBM Romulo E. Hilario'],
                ['name' => 'SBM Marianito P. Foronda'],
                ['name' => 'VM Generoso L. Aquino, Jr.'],
                ['name' => 'Committee on Laws, Rules and Privileges'],
                ['name' => 'Committee on Budget, Finance and Appropriations'],
                ['name' => 'Committee on  Education, History, Culture and Tourism'],
                ['name' => 'Committee on Health and Sanitation'],
                ['name' => 'Committee on Peace and Order, Natural Calamities & Public Safety'],
                ['name' => 'Committee on Ways and Means'],
                ['name' => 'Committee on Trade, Commerce and Industry'],
                ['name' => 'Committee on Public Works and Infrastructure'],
                ['name' => 'Committee on Agriculture, Food Cooperative & Livelihood'],
                ['name' => 'Committee on Youth, Sports Development, Games & Amusement'],
                ['name' => 'Committee on Social Services & Welfare of Senior Citizens and PWD'],
                ['name' => 'Committee on Environment and Natural Resources'],
                ['name' => 'Committee on Women and Family Welfare'],
                ['name' => 'Committee on Barangay Affairs and Administrative Cases'],
                ['name' => 'Committte on God Government, Public Ethics and Accountability'],
                ['name' => 'Committee on Public Utilities and Facilities, Market & Slaughterhouse'],
                ['name' => 'Oversight Committee'],
                ['name' => 'LNB Georgina S. Guillen'],
                ['name' => 'SBM Zaida Hershey S. Mandac'],
                ['name' => 'SBM Lendell Benedict M. Chua'],
                ['name' => 'SBM Wilbor A. Bringas'],
                ['name' => 'SBM Onofre A. Bayag'],
                ['name' => 'LNB Florentino M. Soriano, Jr.']
            ]);
        }
    }
}
