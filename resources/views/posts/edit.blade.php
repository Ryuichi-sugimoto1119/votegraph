@extends('layouts.layouts')

@section('title', 'votegraph')

@section('content')
<div id = "main">
    <div id = "main-title">
        <h1>編集する</h1>
    </div>
<div id ="editForm">
  <form method="POST" action="/edit">
    @csrf
    
    <div class="form-group">
      <label for="formGroupExampleInput"></label>
      <input type="hidden" name = "id" class="form-control" value="{{ $posts->id }}" id="formGroupExampleInput">
    </div>
    <div class="form-group">
      <label for="formGroupExampleInput"></label>
      <input type="text" name = "user" class="form-control" value="{{ $posts->user }}" id="formGroupExampleInput" placeholder="名前">
    </div>
    <div class="form-group">
      <label for="formGroupExampleInput2"></label>
      <input type="text" name = "title" class="form-control"  value="{{ $posts->title }}" id="formGroupExampleInput" placeholder="記事タイトル">
    </div>
    <div class="form-group">
       <label for="textarea1"></label>
       <textarea id="textarea" name = "text" class="form-control" value="{{ $posts->text }}" placeholder="記事本文">{{ $posts->text }}</textarea>
    </div>
  
      <div id = "btn">
          <button type="submit" class="btn btn-outline-primary">編集する</button>
      </div>

  </form>
</div>

    

    
    
</div>

@endsection
