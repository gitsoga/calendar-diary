<?php

namespace Tests\Unit;

use App\Diary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiaryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * getUserDiaryForMonth()のテスト.
     *
     * @return void
     */
    public function testGetUserDiaryForMonth()
    {
        factory(Diary::class)->create([
            'aws_username' => '111111111111111111111111111111111111',
            'date' => '2021-07-20',
        ]);
        factory(Diary::class)->create([
            'aws_username' => '111111111111111111111111111111111111',
            'date' => '2021-07-10',
        ]);
        factory(Diary::class)->create([
            'aws_username' => '111111111111111111111111111111111111',
            'date' => '2021-07-01',
        ]);
        factory(Diary::class)->create([
            'aws_username' => '111111111111111111111111111111111111',
            'date' => '2021-08-01',
        ]);
        factory(Diary::class)->create([
            'aws_username' => '222222222222222222222222222222222222',
            'date' => '2021-07-01',
        ]);

        $response = Diary::getUserDiaryForMonth('111111111111111111111111111111111111', '2021-07');

        $this->assertCount(3, $response);
        $this->assertEquals($response[0]->date, '2021-07-01');
    }
}
