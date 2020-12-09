@extends('layouts.app')

@section('title', $date.'の日記作成')

@section('content')

<h1>{{ $date }}の日記作成</h1>
<div class="container-fluid">
  <form action="{{ action('DiaryController@store') }}" method="POST" class="form-horizontal">
    <div class="form-group">
      <label for="diary">1000文字まで</label>
      <textarea id="diary" name="diary" class="form-control @error('diary') is-invalid @enderror"></textarea>
    </div>
    <input id="date" name="date" type="hidden" value="{{ $date }}">
    @csrf
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>

@endsection
