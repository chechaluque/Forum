@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-7 col-sm-offset-2">
        	
            @forelse($posts as $post)
                
                <div class="jumbotron">
                	
                    <h3 class="media-heading">{{ $post->title }}</h3>
                    <p class="text-right">By: {{ $post->user->name }}</p>
                    <p>{{ $post->body }}</p>
                    <p><i class="glyphicon glyphicon-calendar"></i> Publish: {{ $post->created_at->diffForHumans() }}</p>
                    @if($post->replies->count() > 0 )
                    <li role="presentation" class="active"><a href="{{ route('view_post', [$post->slug]) }}"> {{ $post->replies->count() }} comment(s)<span class="badge"></span></a></li>
                        
                        
                    @else
                        
                        <li>Be the first to reply</li>

                    @endif
                    <p><a class="btn btn-primary text-left" href="{{ route('view_post', [$post->slug]) }}" role="button">More Details</a></p>
                @if(Auth::check() && Auth::user()->id == $post->user_id)
                    {!! Form::open(['route' => 'delete_question','id' => 'delete-question-form', 'method'=> 'DELETE', 'class'=> 'text-right']) !!}
        
                    <div class="form-group">
                    {!! Form::hidden('post_id', $post->id) !!}
                    </div>

                    {!! Form::button('Delete', ['class'=> 'btn btn-danger', 'type'=>'submit', 'id'=>'delete']) !!}
                    
                    {!! Form::close() !!}
                @endif
                </div>
               
                @empty
                <p>No posts found</p>
               
            @endforelse
            <div class="col-sm-7 col-sm-offset-4">
            {!!$posts->links() !!}
            </div>
        </div>
    </div>
@endsection