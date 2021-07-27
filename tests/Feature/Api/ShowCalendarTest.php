<?php

namespace Tests\Feature;

use App\Diary;
use App\Exceptions\DataFormatException;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCalendarTest extends TestCase
{
    use RefreshDatabase;

    /**
     * showCalendar APIのテスト(年月指定あり).
     * @return void
     */
    public function testShowCalendarSetYearMonth()
    {
        $this->insertTestData();

        $this->get('/api/showCalendar/2021-07')
            ->assertStatus(200)
            ->assertJsonFragment([
                'yearMonth' => '2021-07',
                'spaceNum' => '4',
            ])
            ->assertJsonPath('calendars.22.date', '2021-07-22')
            ->assertJsonCount(31, 'calendars');
    }

    /**
     * showCalendar APIのテスト(年月指定なし).
     * @return void
     */
    public function testShowCalendarNoYearMonth()
    {
        Carbon::setTestNow(new Carbon('2021-02-11 10:00:00'));

        $this->insertTestData();

        $this->get('/api/showCalendar')
            ->assertStatus(200)
            ->assertJsonFragment([
                'yearMonth' => '2021-02',
                'spaceNum' => '1',
            ])
            ->assertJsonPath('calendars.28.date', '2021-02-28')
            ->assertJsonCount(28, 'calendars');
    }

    /**
     * showCalendar APIのテスト(不正な年月指定).
     */
    public function testShowCalendarInvalidYearMonth()
    {
        $this->get('/api/showCalendar/202107')
            ->assertStatus(500);
    }

    /**
     * テストデータをDBに挿入.
     * @return void
     */
    private function insertTestData()
    {
        factory(Diary::class)->create([
            'user_id' => 1,
            'date' => '2021-01-11',
        ]);
        factory(Diary::class)->create([
            'user_id' => 1,
            'date' => '2021-02-28',
        ]);
        factory(Diary::class)->create([
            'user_id' => 1,
            'date' => '2021-07-22',
        ]);
        factory(Diary::class)->create([
            'user_id' => 1,
            'date' => '2021-08-13',
        ]);
    }
}
