<?php

use Illuminate\Database\Seeder;

class DiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Diary::class, 50)->create()->each(function ($diary) {
            $diary->posts()->save(factory(App\Post::class)->make());
        });
    }
}
