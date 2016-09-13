@extends('layouts.app')
@section('content')
	{!! Form::open(['route' => 'store','id' => 'post-question-form', 'method'=> 'POST']) !!}
	<div class="form-group">
	{!! Form::label('title', 'Title:') !!}
	{!! Form::text('title', null, ['class'=> 'form-control', 'id' => 'title', 'placeholder'=> 'What is your question?']) !!}
	</div>
	<div class="form-group">
	{!! Form::label('category', 'Category:') !!}
	<select name="category" id="" class="form-control">
		@foreach($categories as $category)
		<option value="{{ $category->id }}">{{ $category->name }}</option>
		@endforeach
	</select>
	</div>
	<div class="form-group">
	{!! Form::label('body', 'Boby:') !!}
	{!! Form::textarea('body', null, ['class'=> 'form-control', 'id' => 'body', 'placeholder'=> 'Tell us about your question']) !!}
	</div>

	{!! Form::button('Post', ['class'=> 'btn btn-lg btn-primary btn-block', 'type'=>'submit']) !!}
    
	{!! Form::close() !!}
@endsection