<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'type' => 'movie',
            'created_at' => Carbon::now()
        ]);
        DB::table('types')->insert([
            'type' => 'season',
            'created_at' => Carbon::now()
        ]);
        DB::table('types')->insert([
            'type' => 'episode',
            'created_at' => Carbon::now()
        ]);
    }
}
