@extends('layouts.app')

@section('title', $yearmonth.'のカレンダー')

@section('css')
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
@endsection

@section('content')

<h1>{{ $yearmonth }}</h1>

<div class="container-fluid">
    <div class="row seven-cols">
        @for ($i = 0; $i < $space_num; $i++)
        <div class="col-md-1 border"></div>
        @endfor
        @foreach($calendars as $day => $calendar)
        <div class="col-md-1 border">
            <div>{{ $day }}</div>
            @isset ($calendar->diary)
            <div>済</div>
            @else
            <div><a href="{{ action('DiaryController@new', ['yearmonthday' => $yearmonth.'-'.$day]) }}">日記を書く</a></div>
            @endisset
        </div>
        @endforeach
    </div>
</div>
@endsection
