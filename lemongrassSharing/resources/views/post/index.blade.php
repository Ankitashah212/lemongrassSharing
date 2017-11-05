@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-6">
         @if (Session::has('success'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('success') }}
                </div>
            @endif
        <form action="" method="post">
         {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <input type="text" name="title" class="form-control" placeholder="Enter your post title">
                    @if ($errors->has('title'))
                        <small class="text-danger">{{ $errors->first('title') }}</small>
                    @endif
                </div>
           
                <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                    <textarea name="body" rows="8" cols="80" class="form-control" placeholder="Enter your post"></textarea>
                    @if ($errors->has('body'))
                        <small class="text-danger">{{ $errors->first('body') }}</small>
                    @endif
                </div>
                
                <input type="submit" value="Post" class="btn btn-primary btn-block">
            </div>
        </div>


        </form>
    </div>
    <div class="col-sm-6">
    @foreach ($posts as $post)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                   Posted By: {{$post->user->name}}, {{$post->title}}
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