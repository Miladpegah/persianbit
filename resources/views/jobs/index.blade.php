@extends('layouts.jobBasic')

@section('in_article')
			<div class="container">
				@if($jobs->isEmpty())
					<div class="nothibg-for-show">
						<h1>We have not any JOB for you</h1>
					</div>
				@else
					@foreach($jobs as $job)
						<div class="card job-card">
						  <div class="card-header">
						    {{ $job->title }}
						  </div>
						  <div class="card-body">
						  	<a href="{{ route('user.show', $job->user) }}">
								<i class="fa fa-user-circle-o">{{ $job->user->name	 }}</i>
							</a>
							<br><br>
						    <p class="card-text">
						    	{{ $job->body }}
						    </p>
						    <a href="{{ route('jobs.show', $job) }}" class="btn btn-primary">More information</a>
						  </div>
						</div>	
					@endforeach
				@endif
			</div>
@stop