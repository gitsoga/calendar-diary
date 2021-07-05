@extends('layouts.app')

@section('title', 'のカレンダー')

@section('css')
@endsection

@section('content')
<div id="vue_diary">
</div>
<script src="{{ mix('js/diary.js') }}"></script>
@endsection
