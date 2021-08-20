@extends('layouts.lessonsBasic')

@section('in_article')
    	@if($padcasts->isEmpty())
    		<h1>We have not any padcast for you</h1>
    	@else
    		<div class="col-md-12">
				@foreach($padcasts as $padcast)
					<div class="card padcst-card">
					  <div class="card-header padcast-header">
					   {{ $padcast->title }}
					  </div>
					  <div class="card-body" style="width: 100%;">
					    <p class="card-text">{{ $padcast->body }}</p>
					    <audio controls src="/{{ $padcast->path }}" style="width: 100%;"></audio>
					  </div>
					</div>
				@endforeach
			</div>
    	@endif
@stop