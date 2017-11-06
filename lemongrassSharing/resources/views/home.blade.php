

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
         
              
                    <div>
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#posts" aria-controls="posts" role="tab" data-toggle="tab">Your Posts ({{ Auth::user()->posts()->count() }})</a></li>
                        <li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Comments</a></li>
                        <li role="presentation"><a href="#categories" aria-controls="categories" role="tab" data-toggle="tab">Categories</a></li>
                       </ul>
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active fade in" id="posts">

                            @foreach (Auth::user()->posts as $post)
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h3 class="panel-title">
                                        {{ $post->title }} |     
                                        Category : {{ $post->category->name }}
                                    </h3>
                                  </div>
                                  <div class="panel-body">
                                    {{ $post->body }}
                                
                                  </div>
                                  <div class="panel-footer">
                                    <a href="{{ route('post.edit', [$post->id]) }}" class="btn btn-primary">Edit </a>
                                    <a href="#" onclick="document.getElementById('delete').submit()" class="btn btn-primary">Delete </a>
                                        {!! Form::open(['method' => 'DELETE', 'id' => 'delete', 'route' => ['post.delete', $post->id]]) !!}
                                        {!! Form::close() !!}
                                </div>
                                </div>
                            @endforeach
                        </div>
                  
                        <div role="tabpanel" class="tab-pane fade" id="comments">
                            {{ Auth::user()->comments()->count() }} Comments created
                            @foreach (Auth::user()->comments as $comment)
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="col-sm-9">
                                        {{ $comment->comment }}
                                    </div>
                                    <div class="col-sm-3">
                                        <small><a href="{{ route('post.show', [$comment->post->id]) }}">View Post</a></small>
                                    </div>
                                  </div>
                                </div>
                            @endforeach
                         </div>
                  
                        <div role="tabpanel" class="tab-pane fade" id="categories">

                            @foreach (Auth::user()->categories as $category)
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    {{ $category->name }}
                                  </div>
                                </div>
                            @endforeach
                        </div>
                      
                        
            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
