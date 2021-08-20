@extends('layouts.dashboardBasic')

@section('in_article')
	<h1 style="text-align: center">{{ $user->name }} Lessons</h1>
	<a href="{{ route('lessons.create') }}" class="btn btn-success bt-lg" style="margin-left: 43%;">NEW LESSON</a>
	@if($lessons->isEmpty())
    	<h1>You have no lesson</h1>
	@else
    	@if($lessons->isEmpty())
    		<h1>You didn't write ARTICLES</h1>
    	@else
    		<div class="col-md-12">
				@foreach($lessons as $lesson)
					<div class="card" style="width: 18rem;display: inline-block;margin: 1em">
			  			<div class="card-body">
			    			<h1 class="card-title" style="text-align: center">{{ $lesson->title }}</h1>
			   				 <a href="{{ route('lessons.show', $lesson) }}" class="btn btn-primary">More Information</a>
			  			</div>
					</div>
				@endforeach
			</div>
    	@endif
  	@endif
@stop