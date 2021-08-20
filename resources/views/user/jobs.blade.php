@extends('layouts.dashboardBasic')

@section('in_article')
	<br>
	<a href="{{ route('jobs.create') }}" class="btn btn-success bt-lg" style="margin-left: 43%;">NEW JOB</a>
	@if($jobs->isEmpty())
    	<h1 style="text-align: center">{{ $user->name }} jobs is empty</h1>
	@else
		<h1 style="text-align: center">{{ $jobs->count() }} {{ $user->name }} jobs</h1>
    	<table class="table table-dark">
  			<thead>
			    <tr>
			      <th scope="col">Job</th>
			      <th scope="col">Action</th>
			    </tr>
  			</thead>
	  		<tbody>
			    @foreach ($jobs as $job)
			      <tr>
			      <td>{{ $job->title }}</td>
			      <td>
			        <a href="{{ route('jobs.show', $job) }}">Show</a>
			        |
			        <a href="{{ route('jobs.edit', $job) }}">Edit</a>
			      </td>
			    </tr>
			    @endforeach
			</tbody>
		</table>
  	@endif
@stop