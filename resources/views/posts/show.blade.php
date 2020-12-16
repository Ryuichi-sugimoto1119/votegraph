<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{ asset('js/localstorage.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/submit_user.js') }}"></script>

@extends('layouts.layouts')

@section('title', 'votegraph')

@section('content')
<div id = "main">
    <div class="card">
        <div id = "main-title">
            <div class="container">
                <div class="row">
                    <div class="col-7" style="">
                        <h1 class="card-title">{{$posts->title}}</h1>
                    </div>
                    <div class="col-2" style="">
                        <h2 class="card-title">{{$posts->user}}</h2>  
                    </div>
                    
    
                    <div id ="showLink" class="col-3" style="">
                        <div class="row">
                            <div class="col-5" style="">
                                <button onclick="location.href='{{ route('edit.show', ['id' => $posts->id]) }}'" class="btn btn-outline-primary">編集</button>
                            </div>
                            <div class="col-5" style="">
                                <form action="{{ url('delete/'.$posts->id) }}" method="POST" onsubmit="if(confirm('本当に削除しますか？')) { return true } else {return false };">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $posts->id }}">
                                    <button type="submit" class="btn btn-outline-primary" name="_method" value="DELETE">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>  
        　　</div>
        </div>
    
    
                <div class="col-10" style="">
                    <h2 class="card-title">{{$posts->text}}</h2>  
                </div>
                
                <div class="row">
                    <div class="col-5" style="">
                        @foreach ($playerChoicesList as $k => $pCL)
                            <p>{{$k}}</p>
                            <p>{{$pCL['count']}}</p>
                        @endforeach
                    </div>
                    
                      @component('posts.chartist', ['key' => $posts->id ,'data' => $player_result[$posts->id]['data'], 'label' => $player_result[$posts->id]['label']])
                                @endcomponent
                    
                    
                    
                    <div class="col-7" style="">
                        @foreach ($posts->answers as $answer)
                            <form method="POST" action="/player" id="player{{$answer->id}}">
                                 @csrf
                                <input type="hidden" name="id" value="{{$posts->id}}">
                                <input type="hidden" name="answer_id"value="{{$answer->id}}">
                                <input type="hidden" name="choices" value="{{$answer->choices}}">
                            </form>
                            
                                @if($answer->id == $answer_id)
                                    <form action="{{ url('player/'.$answer->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="{{$posts->id}}">
                                        <input type="hidden" name="answer_id"value="{{$answer->id}}">
                                        <input type="hidden" name="choices" value="{{$answer->choices}}">
                                        <button type="submit" class="btn-outline-primary">{{$answer->choices}}に投票しました</button>
                                    </form>
                               @elseif($answer_id == 0)
                                    <button type="submit" form="player{{$answer->id}}" class="btn btn-link">{{$answer->choices}}</button>
                                @endif
                                

                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div id = "coment">
                    @foreach($commentList as $cml)
                        <h3>{{$cml->player_name}}</h3>
                        <p>{{$cml->comment}}</p>
                        <h4>{{$cml->created_at->format('20y.m.d.H:i')}}</h4>
                    @endforeach
                    
                    <a href = "{{ route('comment.show', ['id' => $posts->id]) }}">コメントする</a>
                </div>
            </div>
            
            
         </div>


@endsection





