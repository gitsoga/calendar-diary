@extends('layouts.app')

@section('title', $yearmonth.'のカレンダー')

@section('content')
        <h1>{{ $yearmonth }}</h1>

<div class="container-fluid">
  <div class="row row-cols-7">
@foreach($calendars as $day => $calendar)
        <div class="col-md-2 border">
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
