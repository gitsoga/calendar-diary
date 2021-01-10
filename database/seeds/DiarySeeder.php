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
        // User5件作成する
        // その際にUser1件に対応するDiaryを10件作る
        factory(App\User::class, 5)
            ->create()
            ->each(
                function ($user) {
                    factory(App\Diary::class, 10)
                        ->create(['user_id' => $user->id]);
                });
    }
}
