@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-6 col-sm-offset-3">
        @foreach ($posts as $post)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                   Posted By: {{$post->user->name}}, 
                   {{$post->title}}
                   Category: <div class="label label-default">{{ $post->category['name'] }}</div>
                </h3>
            </div>
            <div class="panel-heading">
                <p class="panel-body">
                    {{$post->body}}
                </p>
            </div>
            <div class="panel-footer">        
                <a href="#" class="btn btn-link like">Comment </a>
            </div>
         
        </div>
        @endforeach
  
        </div>
    </div>
@endsection
