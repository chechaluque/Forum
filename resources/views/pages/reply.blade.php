@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-9 col-sm-offset-2">
        	
            
              
            <div class="well">
               <div class="media">
                   <div class="media-body">
                       <h4 class="media-heading">{{ $post->title }}</h4>
                       <p class="text-right">By: {{ $post->user->name }}</p>
                       <p>{{ $post->body }}</p>
                       <ul class="list-inline list-unstyled">
                           <li> <span> <i class="glyphicon glyphicon-calendar"></i>{{  $post->created_at->diffForHumans() }}</span></li>
                       </ul>
                   </div>
               </div>



           </div>
               <blockquote> 
          @forelse($post->replies as $reply)     

               <div class="well reply">
                   <div class="media">
                       <div class="media-body">
                           <p class="text-right">By: {{ $reply->user->name }}</p>
                           <p>{{ $reply->body }}</p>
                           
                           <ul class="list-inline list-unstyled">
                               <li> <span> <i class="glyphicon glyphicon-calendar"></i>{{  $reply->created_at->diffForHumans() }}</span></li>
                           </ul>
                       </div>
                   </div>

                 @if(Auth::check() && Auth::user()->id == $reply->user_id)
                    {!! Form::open(['route' => 'delete_reply','id' => 'delete-reply-form', 'method'=> 'DELETE', 'class'=> 'text-right']) !!}
        
                    <div class="form-group">
                    {!! Form::hidden('reply_id', $reply->id) !!}
                    </div>

                    {!! Form::button('Delete', ['class'=> 'btn btn-danger', 'type'=>'submit', 'id'=>'delete']) !!}
                    
                    {!! Form::close() !!}
                @endif

               </div>
            @empty
            </blockquote>   
                <p>Be the first to reply</p>
            
        @endforelse

        <div class="col-sm-12">
    @if(Auth::check())
    {!! Form::open(['route' => 'store_reply','id' => 'reply-question-form', 'method'=> 'POST']) !!}
    
    <div class="form-group">
    {!! Form::hidden('slug', $post->slug) !!}

    {!! Form::textarea('body', null, ['class'=> 'form-control', 'id' => 'body', 'placeholder'=> 'Type your reply here', 'required']) !!}
    </div>

    {!! Form::button('Reply', ['class'=> 'btn btn-lg btn-primary btn-block', 'type'=>'submit']) !!}
    
    {!! Form::close() !!}

     @endif     
        </div>
    </div>
</div>
@endsection