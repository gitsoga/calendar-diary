<?php

namespace Tests\Unit;

use App\Diary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiaryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * getUserDiaryForMonth()のテスト
     *
     * @return void
     */
    public function testGetUserDiaryForMonth()
    {
        factory(Diary::class)->create([
            'user_id' => 1,
            'date' => '2021-07-01',
        ]);
        factory(Diary::class)->create([
            'user_id' => 1,
            'date' => '2021-07-10',
        ]);
        factory(Diary::class)->create([
            'user_id' => 1,
            'date' => '2021-07-20',
        ]);
        factory(Diary::class)->create([
            'user_id' => 1,
            'date' => '2021-08-01',
        ]);
        factory(Diary::class)->create([
            'user_id' => 2,
            'date' => '2021-07-01',
        ]);

        $response = Diary::getUserDiaryForMonth(1,'2021-07');

        $this->assertCount(3, $response);
    }
}
