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
                            <li role="presentation"><a href="#posts">Post</a></li>
                            <li role="presentation"><a href="#comments">Comment</a></li>
                        </ul>
                            
                        <div class="tab-content">
                            <div class="tab-pane" id="posts">...</div>
                            <div class="tab-pane" id="comments">...</div>
                      
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
