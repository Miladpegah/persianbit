@extends('layouts.dashboardBasic')

@section('in_article')
	<h1 style="text-align: center">4 questions is followed</h1>
	<table class="table table-dark">
  <tbody>
    @foreach($followers as $follower)
      <tr>
        <th scope="row"><img src="{{ $follower->user->photo_path }}" style="width: 3%;"></th>
        <td><a href="{{ route('user.show', $follower->user) }}">{{ $follower->user->name }}</a></td>
      </tr>
    @endforeach
   </tbody>
</table>
@stop