@extends('layouts.lessonsBasic')

@section('in_article')
    	@if($articles->isEmpty())
    		<h1>We have not any article for you</h1>
    	@else
    		<div class="col-md-12">
				@foreach($articles as $article)
					<div class="card" style="width: 18rem;display: inline-block;margin: 1em">
			  			<div class="card-body">
			  				<img class="card-img-top" src="{{ $article->poster_path }}" alt="Card image cap">
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
@stop