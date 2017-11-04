@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome {{Auth :: user()->name}}


                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#posts" aria-controls="posts" role="tab" data-toggle="tab">Your Posts</a></li>
                      
                            <li role="presentation"><a href="#comments">Comment</a></li>
                        </ul>
                            
                        <div role="tabpanel" class="tab-pane active fade in" id="posts">
                            {{ Auth::user()->posts()->count() }} Posts created
                            @foreach (Auth::user()->posts as $post)
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h3 class="panel-title">
                                        {{ $post->title }}
                                      
                                       
                                    </h3>
                                  </div>
                                  <div class="panel-body">
                                    {{ $post->body }}
                                   
                                  </div>
                                </div>
                            @endforeach
                        </div>


                            <div class="tab-pane" id="comments">


                            </div>
                      
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
