@extends('layouts.lessonsBasic')

@section('in_article')
    	@if($lessons->isEmpty())
    		<h1>We have not any lesson for you</h1>
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
@stop