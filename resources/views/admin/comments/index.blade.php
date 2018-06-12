@extends('layouts.admin')

@section('content')

    @if(count($comments) > 0)
    <h1>Comments</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th colspan="2">Link</th>
                <th>Approve?</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)

            <tr>
                <td>{{$comment->id}}</td>
                <td>{{$comment->author}}</td>
                <td>{{$comment->email}}</td>
                <td>{{$comment->body}}</td>
                <td><a href="{{route('home.post', $comment->post->slug)}}">View Post</a></td>
                <td><a href="{{route('admin.comment.replies.show', $comment->id)}}">View Replies</a></td>
                <td>

                    {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}

                    @if($comment->is_active == 1)

                        <input type="hidden" name="is_active" value="0">

                        <div class="form-group">
                            {!! Form::submit('Un-approve', ['class'=>'btn btn-success']) !!}
                        </div>

                    @else

                        <input type="hidden" name="is_active" value="1">

                        <div class="form-group">
                        {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                        </div>

                    @endif

                    {!! Form::close() !!}

                </td>
                <td>

                    {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}

                    <div class="form-group">
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                    </div>

                    {!! Form::close() !!}

                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

    @else

        <h1 class="text-center">No Comments</h1>

    @endif

@stop
