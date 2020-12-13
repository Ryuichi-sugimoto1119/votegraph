<link rel="stylesheet" href="css/stylesheet.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{ asset('js/localstorage.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/convert_url.js') }}"></script>

@extends('layouts.layouts')

@section('title', 'votegraph')

@section('content')

<div id = "main">
    @foreach ($posts as $p)
        <div class="card">
            <div class="card-block">
                <div id = "main-content">
        
                    <div id = "main-title">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-13 col-lg-9" style="">
                                    <h1>{{$p->title}}</h1>
                                </div>
                                <div class="col-sm-13 col-lg-2" style="">
                                    <h2>{{$p->user}}</h2>  
                                </div>
                            </div>  
                        </div> 
                    </div>
                    
    
                    <div class="col-2" style="">
                        <div id = "content-link">
                            <button onclick="location.href='{{ route('detail.show', ['id' => $p->id]) }}'" class="btn btn-outline-primary">投票する</button>
                        </div>
                    </div>
                    
                    <div class="container">
                        <div id ="main-choice">
                            <div class="row">
                                <div class="col-sm-13 col-lg-4" style="">
                                    @component('posts.chartist', ['key' => $p->id ,'data' => $player_result[$p->id]['data'], 'label' => $player_result[$p->id]['label']])
                                    @endcomponent
                                </div>
                                <div class="col-sm-13 col-lg-7" style="">
                                   <p>{{$player_result[$p->id]['label']}}</p>
                                   <p> 各投票数:{{$player_result[$p->id]['data']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    
    @endforeach
</div>
@endsection





