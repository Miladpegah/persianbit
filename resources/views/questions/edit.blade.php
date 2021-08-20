@extends('layouts.questionBasic')

@section('in_article')
			<!-- Answeres -->
			<div class="answer">
				<div class="answere-question">
						<div class="add-comment">
							<form method="POST" action="{{ route('question.update', $question) }}">
								@method('PATCH')
					            @csrf
					            <div class="comment-input">
					                <x-label for="name" :value="__('Choice a name for conversation')" />

					                <x-input id="text" class="block mt-1 w-full " type="text" name="title" value="{{ $question->title }}" required autofocus placeholder="title"/>
					            </div>
					            <div class="form-group">
					            	<x-label for="name" :value="__('Ask here')" />
								    <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3" cols="80%" placeholder="minimum caracter is 120" required autofocus>{{ $question->body }}</textarea>
								</div>
								<div class="form-group" style="width: 100%;">
									<x-label for="name" :value="__('Tags')" />
									<select name="tags[]" class="form-control js-example-tokenizer" multiple="multiple" required autofocus>
                                    	@foreach($tags as $tag)
                                    		<option value="{{ $tag->id }}"
                                    			@foreach($question->tags as $questionTag)
	                                    			@if($questionTag->id == $tag->id)
	                                    				selected
	                                    			@endif
                                    			@endforeach
                                    			>
                                    			{{ $tag->name }}
                                    		</option>
                                    	@endforeach
                                	</select>
								</div>
									
					                <x-button class="ml-4 comment-button">
					                    {{ __('UPDATE') }}
					                </x-button>
		        			</form>
						</div>
				</div>
			</div>

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript">
	    $(".js-example-tokenizer").select2({
		    tags: true,
		    tokenSeparators: [',', ' ']
		})
	</script>
@stop