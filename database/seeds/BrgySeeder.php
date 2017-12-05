<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\RefBrgy;

class BrgySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (RefBrgy::all()->count() == 0) {
            $brgys = Storage::disk('local')->get('ref/json/refbrgy.json');
            $data = json_decode($brgys);

            foreach ($data->RECORDS as $key => $brgy) {
                if ($brgy->citymunCode == env('MUN_CODE')) {
                    RefBrgy::create([
                        'brgyCode' => $brgy->brgyCode,
                        'brgyDesc' => $brgy->brgyDesc
                    ]);
                }
            }
        }
    }
}
