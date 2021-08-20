@extends('layouts.jobBasic')

@section('in_article')
			<div class="container">
				<div class="job-header">
					<h1>
						{{ $job->title }}
					</h1>
				</div>
				<div class="job-body">
					<br><br>
					<p>
						{{ $job->body }}
					</p>
					<a href="{{ route('user.show', $job->user) }}">
						<i class="fa fa-user-circle-o">{{ $job->user->name }}</i>
					</a>
					@if($job->user->id == auth()->user()->id)
						<form action="{{ route('jobs.destroy', $job) }}" method="POST">
						   	@csrf
						   	@method('DELETE')
						   	<button>
						  	 	<i class="fa fa-trash-o fa-lg"></i>
						   	</button>
					    </form>
					    <a href="{{ route('jobs.edit', $job) }}">
							<i class="fa fa-pencil"></i>
						</a>
					@endif
				</div>
				<div class="job-call-information">
					<h1>
						Contact information
					</h1>
					<h2>
						Phone : {{ $job->phone }}
					</h2>
					<h2>
						{{ $job->email }}
					</h2>
					<h2 style="display: inline-block;">
						Address : 
					</h2>
					<p style="display: inline-block;">{{ $job->address }}</p>
				</div>
			</div>
@stop