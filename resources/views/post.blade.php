@extends('layouts.blog-home')

@section('content')

    <div class="row">

        <div class="col-md-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$post->title}}</h1>

            <!-- Author -->
            <p class="lead">
                by {{$post->user->name}}
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

            <!-- Category -->
            <p><span class="glyphicon glyphicon-folder-open"></span>&nbsp;{{$post->category ? $post->category->name : 'Uncategorized'}}</p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/900x300'}}" alt="">

            <hr>

            <!-- Post Content -->
            <p>{!! $post->body !!}</p>

            <hr>

            <!-- Blog Comments -->

            <!-- comment message flash -->


        @if(Auth::check())

            <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>

                    {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

                    <input type="hidden" name="post_id" value="{{$post->id}}">

                    <div class="form-group">
                        {!! Form::label('body', 'Body:') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>

            @endif

            <hr>

            <!-- Posted Comments -->
            @if(count($comments) > 0)

                @foreach($comments as $comment)

                <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$comment->author}}
                                <small>{{$comment->created_at->diffForHumans()}}</small>
                            </h4>
                            <p>{{$comment->body}}</p>

                            @if($comment->replies)

                                @foreach($comment->replies as $reply)

                                    @if($reply->is_active == 1)

                                        <div class="nested-comment media">
                                            <a class="pull-left" href="#">
                                                <img height="64" class="media-object" src="{{$reply->photo}}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{$reply->author}}
                                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                                </h4>
                                                <p>{{$reply->body}}</p>
                                            </div>
                                        </div>

                                    @endif

                                @endforeach

                            @endif

                            <div class="comment-reply-container">

                                <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                                <div class="comment-reply col-sm-9">

                                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}

                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                    <div class="form-group">
                                        {!! Form::label('body', 'Body:') !!}
                                        {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                                    </div>

                                    {!! Form::close() !!}

                                </div>

                            </div>

                        </div>
                    </div>

                @endforeach

            @endif

        </div>

        <!-- Blog Sidebar -->
        @include('includes.front_side_nav')

    </div>

@stop

@section('scripts')

    <script>
        $(".comment-reply-container .toggle-reply").click(function () {
            $(this).next().slideToggle("slow");
        });
    </script>


@stop