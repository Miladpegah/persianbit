@extends('layouts.questionBasic')

@section('in_article')
			@foreach($questions as $question)
				<a href="{{ route('questions.show', $question) }}" class="question-link">
					<div class="col-lg-9" style="padding-bottom: 10%;">
						<div class="card">
						  <div class="card-header
						  	@if ($question->answered == false)
						  		not-answered
						  	@endif
						  	@if ($question->answered == true)
						  		answered
						  	@endif
						  	@if ($question->block == true)
						  		blocked
						  	@endif

						  ">
						    {{ $question->title }}
						  </div>
						  <div class="card-body">
						  	<a href="{{ route('user.show', $question->user) }}">
						  		<i class="fa fa-user-circle-o">{{ $question->user->name	 }}</i>
						  	</a>
						  	&nbsp;&nbsp;&nbsp;
						  	<i class="fa fa-commenting">{{ $question->answeres->count()	 }}</i>
						  	&nbsp;&nbsp;&nbsp;
						  	<i class="fa fa-legal" style="color:#9d2222">{{ $question->vote }}</i><br><br>
						    <p class="card-text">{{ $question->body }}</p>
						    <br><br>
						    @foreach($question->tags as $tag)
						    	<span class="badge badge-pill badge-dark">{{ $tag->name }}</span>&nbsp;
						    @endforeach
						  </div>
						</div>
					</div>
				</a>
			@endforeach
@stop