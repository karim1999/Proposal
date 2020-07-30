<?php

use App\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $theme= new Theme();
        $theme->name= "default";
        $theme->file= "default";
        $theme->save();
    }
}
