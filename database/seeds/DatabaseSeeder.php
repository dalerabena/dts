<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            PrioritiesSeeder::class,
            UsersSeeder::class,
            AuthorSeeder::class,
            CoAuthorSeeder::class,
            CommitteeActionSeeder::class,
            CoSponsorSeeder::class,
            ProponentSeeder::class,
            ReferredToSeeder::class,
            RefLawSeeder::class,
            SBActionSeeder::class
        ]);
    }
}
