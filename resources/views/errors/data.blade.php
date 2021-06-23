@extends('layouts.app')

@section('title', 'パラメータエラー')

@section('css')
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <p>{{ $errorMsg }}</P>
    <a href="/"><button type="button" class="btn btn-outline-dark">TOPに戻る</button></a>
</div>
@endsection
