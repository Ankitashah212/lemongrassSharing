@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-4">
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
                <label for="title">New Post</label>
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
                <div class="form-group">
                <label for="category"> Select category</label>
                    <select class="form-control" name="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
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
                   Posted By: {{$post->user->name}}, 
                   {{$post->title}}
                   Category: <div class="label label-default">{{ $post->category['name'] }}</div>
                   <div class="pull-right">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('post.show', [$post->id]) }}">Show Post</a></li>
                                    <li><a href="{{ route('post.edit', [$post->id]) }}">Edit Post</a></li>

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
    <div class="col-sm-2">
    <label for=""> Click on category to see all listings</label> 
            @foreach ($categories as $category)
                <a href="{{ route('category.listAll', [$category->name]) }}" class="label label-default">{{ $category->name }}</a>
           <br>
            @endforeach
        </div>
</div>
@endsection