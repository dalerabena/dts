<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferredToSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('referred_tos')->get()->count() == 0) {
            DB::table('referred_tos')->insert([
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
                ['name' => 'Committee of the Whole']
            ]);
        }
    }
}
