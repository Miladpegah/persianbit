@extends('layouts.questionBasic')

@section('in_article')
			<!-- Answeres -->
			<div class="col-md-10">
						<div class="add-comment">
							<form method="POST" action="{{ route('question.store', $user) }}">
					            @csrf
					            <div class="comment-input">
					                <x-label for="name" :value="__('Choice a name for conversation')" />

					                <x-input id="text" class="block mt-1 w-full" type="text" name="title" :value="old('text')" required autofocus placeholder="title"/>
					            </div>
					            <div class="form-group">
					            	<x-label for="name" :value="__('Ask here')" />
							    	<label id="remaining" style="opacity: .5;">The remaining characters : 120</label>
								    <textarea onkeydown="passToReviw(this.value)" class="form-control" name="body" id="exampleFormControlTextarea1" rows="3" cols="80%" placeholder="minimum caracter is 120" required autofocus minlength="120"></textarea>
								</div>
								<div class="form-group" style="width: 100%;">
									<x-label for="name" :value="__('Tags')" />
									<select name="tags[]" class="form-control js-example-tokenizer" multiple="multiple" required autofocus>
                                    	@foreach($tags as $tag)
                                    		<option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    	@endforeach
                                	</select>
								</div>
										<h3 id="reviewHeader" style="text-align: center;opacity: .5;"></h3>
										<div class="markdown-body" id="review" style="width: 100%;background-color: #a6a6a6;border-radius: 20px;">
										</div>
					                <x-button class="ml-4 comment-button">
					                    {{ __('ASK') }}
					                </x-button>
		        			</form>
						</div>
			</div>


	<script type="text/javascript">
        function passToReviw(value) {
          let fieldInner = value;
          let total = 120 - value.length;
          let reviewField = document.getElementById('review');
          let reviewHeader = document.getElementById('reviewHeader');
          let reminder = document.getElementById('remaining');

          reviewField.innerHTML = marked(fieldInner);
          reviewHeader.innerHTML = 'Review';
          if (total > 0) {
          	reminder.innerHTML = 'The remaining characters : ' + total;
          }else{
          	reminder.innerHTML = 'The remaining characters : 0';
          }
          if (fieldInner != null || fieldInner != '') {
            reviewField.style.padding = '2rem';
          }
          if (! value) {
          	reviewField.innerHTML = value;
            reviewField.style.padding = null;
            reviewHeader.innerHTML = null;
            reminder.innerHTML = 'The remaining characters : 120';
            }
        }
    </script>

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	
	<script type="text/javascript">
	    $(".js-example-tokenizer").select2({
		    tags: true,
		    tokenSeparators: [',', ' ']
		})
	</script>
@stop