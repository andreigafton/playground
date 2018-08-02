<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name' => 'Max Number of Colors',
            'slug' => 'max-colors',
            'value' => 10,
        ]);

        DB::table('settings')->insert([
            'name' => 'Max Colors per group',
            'slug' => 'max-per-group',
            'value' => 2,
        ]);
    }
}
