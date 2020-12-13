@extends('layouts.layouts')

@section('title', 'votegraph')

@section('content')
<div id = "main">
    <div id = "main-title">
        <h1>投稿する</h1>
    </div>

<form method="POST" action="/submit">
  @csrf
  <div class="form-group">
    <label for="formGroupExampleInput"></label>
    <input type="text" name = "user" class="form-control" id="formGroupExampleInput" placeholder="名前">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2"></label>
    <input type="text" name = "title" class="form-control" id="formGroupExampleInput" placeholder="記事タイトル">
  </div>
  <div class="form-group">
     <label for="textarea1"></label>
     <textarea id="textarea1" name = "text" class="form-control" placeholder="記事本文"></textarea>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput"></label>
    <input type="text" name = "answers[]" class="form-control" id="formGroupExampleInput" placeholder="回答">
  </div>
  
  <div id="copy">
    <div class="form-group">
      <label for="formGroupExampleInput"></label>
      <input type="text" name = "answers[]" class="form-control" id="formGroupExampleInput" placeholder="回答">
    </div>
  </div>
  <div id="tuika"></div>
  <input type="button" class="btn btn-outline-primary" id="test" value="選択肢を追加する">
  



  <div id ="submitBtn">
     <div id = "btn">
      <button type="submit" class="btn btn-outline-primary">投稿する</button>
    </div>
  </div>
   

</form>

</div>

@endsection
