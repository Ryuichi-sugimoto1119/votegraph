@extends('layouts.layouts')

@section('title', 'votegraph')

@section('content')
<div id = "main">
    <div id = "main-title">
        <h1>コメントする</h1>
    </div>

<form method="POST" action="/comment">
  @csrf
   <div class="form-group">
    <label for="formGroupExampleInput"></label>
    <input type="hidden" name = "id" class="form-control" value="{{ $posts->id }}" id="formGroupExampleInput">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput"></label>
    <input type="text" name = "player_name" class="form-control" id="formGroupExampleInput" placeholder="名前">
  </div>
  <div class="form-group">
     <label for="textarea1"></label>
     <textarea id="textarea1" name = "comment" class="form-control" placeholder="コメント本文"></textarea>
  </div>

    <div id = "btn">
      <button type="submit" class="btn btn-light">送信する</button>
    </div>

</form>

</div>

@endsection