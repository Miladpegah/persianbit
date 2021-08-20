@extends('layouts.dashboardBasic')

@section('in_article')
	@if($answeres->isEmpty())
    	<h1>You have no answere</h1>
	@else
		<h1 style="text-align: center">Answeres</h1>
    	<table class="table table-dark">
  			<thead>
			    <tr>
			      <th scope="col">Answere</th>
			      <th scope="col">Action</th>
			    </tr>
  			</thead>
	  		<tbody>
			    @foreach ($answeres as $answere)
			      <tr>
			      <td>{{ $answere->body }}</td>
			      <td>
			        <a href="#">Show</a>
			      </td>
			    </tr>
			    @endforeach
			</tbody>
		</table>
  	@endif
@stop