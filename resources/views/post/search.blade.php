@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-6 col-sm-offset-3">
        @foreach ($posts as $post)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                   Posted By: {{$post->username}}, 
                   {{$post->title}}
                   Category: <div class="label label-default">{{ $post->cat }}</div>
                   <div class="pull-right">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('post.show', [$post->id]) }}">Show Post</a></li>
                                  
                                </ul>
                            </div>
                        </div>
                </h3>
            </div>
            <div class="panel-heading">
                <p class="panel-body">
                    {{$post->body}}
                </p>
            </div>
            <div class="panel-footer">        
               
               <a href="{{ route('post.show', [$post->id]) }}" class="btn btn-link">Comment</a>
        
            </div>   
        </div>
        @endforeach
  
        </div>
    </div>
@endsection
