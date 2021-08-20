@extends('layouts.dashboardBasic')

@section('in_article')
	<h1 style="text-align: center">{{ $user->name }} Articles</h1>
	<a href="{{ route('articles.create') }}" class="btn btn-success bt-lg" style="margin-left: 43%;">NEW ARTICLE</a>
	@if($articles->isEmpty())
    	<h1>You have no Article</h1>
	@else
    	@if($articles->isEmpty())
    		<h1>You didn't write ARTICLES</h1>
    	@else
    		<div class="col-md-12">
				@foreach($articles as $article)
					<div class="card" style="width: 18rem;display: inline-block;margin: 1em">
			  			<div class="card-body">
			    			<h1 class="card-title" style="text-align: center">{{ $article->title }}</h1>
			    			<h4>sources: </h4><br>
			    			<p class="card-text">{{ $article->source_email }}</p>
			    			<p class="card-text">
			    				<a href="{{ $article->source_link }}">{{ $article->source_link }}</a>
			    			</p>
			   				 <a href="{{ route('articles.show', $article) }}" class="btn btn-primary">More Information</a>
			  			</div>
					</div>
				@endforeach
			</div>
    	@endif
  	@endif
@stop