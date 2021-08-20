@extends('layouts.questionBasic')

@section('in_article')
	@if($user->followQuestions->isEmpty())
      <h1 style="text-align: center">Nothing followed</h1>
  	@else
      <h1 style="text-align: center">{{ $user->followQuestions->count() }} questions are followed</h1>
			@foreach($user->followQuestions as $follow)
					<a href="{{ route('questions.show', $follow->question) }}" class="question-link">
						<div class="col-lg-9" style="padding-bottom: 10%;">
							<div class="card">
							  <div class="card-header
							  	@if ($follow->question->answered == false)
							  		not-answered
							  	@endif
							  	@if ($follow->question->answered == true)
							  		answered
							  	@endif
							  	@if ($follow->question->block == true)
							  		blocked
							  	@endif

							  ">
							    {{ $follow->question->title }}
							  </div>
							  <div class="card-body">
							  	<a href="{{ route('user.show', $follow->question->user) }}">
							  		<i class="fa fa-user-circle-o">{{ $follow->question->user->name	 }}</i>
							  	</a>
							  	&nbsp;&nbsp;&nbsp;
							  	<i class="fa fa-commenting">{{ $follow->question->answeres->count()	 }}</i>
							  	&nbsp;&nbsp;&nbsp;
							  	<i class="fa fa-legal" style="color:#9d2222">{{ $follow->question->vote }}</i><br><br>
							    <p class="card-text">{{ $follow->question->body }}</p>
							    <br><br>
							    @foreach($follow->question->tags as $tag)
							    	<span class="badge badge-pill badge-dark">{{ $tag->name }}</span>&nbsp;
							    @endforeach
							  </div>
							</div>
						</div>
					</a>
			@endforeach
		@endif
@stop