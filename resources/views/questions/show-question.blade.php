@extends('layouts.questionBasic')

@section('in_article')
			<div class="question-content">
				<div class="question-show">
				<div class="question-title">
					<h1>{{ $question->title }}</h1>
				</div>
				<hr>
				<div class="question-center">
					<div class="question-action">
						@livewire('manage-question-vote', [$question])
					</div>
					<div class="question-body markdown-body">
						{{ markdown($question->body) }}
					</div>
				</div>
				<div class="question-tags">
					@foreach($question->tags as $tag)
						<span class="badge badge-pill badge-dark">{{ $tag->name }}</span>&nbsp;
					@endforeach
				</div>
				<div class="question-asker">
					<div class="actions">
						@can('update', $question)
							<div>
								<a href="{{ route('question.edit', $question) }}">
		                                {{ __('edit')}}
		                        </a>
							</div>
							<div>
								<form method="POST" action="{{ route('question.destroy', $question) }}">
									@method('DELETE')
		                            @csrf
		                            <x-dropdown-link :href="route('question.destroy', $question)"
		                                    onclick="event.preventDefault();
		                                                this.closest('form').submit();">
		                                        {{ __('delete')}}
		                            </x-dropdown-link>
		                        </form>
							</div>
							@if($question->block == false)
								<div>
									<form method="POST" action="{{ route('block.question', $question) }}">
			                            @csrf
			                            <x-dropdown-link :href="route('block.question', $question)"
			                                    onclick="event.preventDefault();
			                                                this.closest('form').submit();">
			                                        {{ __('block')}}
			                            </x-dropdown-link>
			                        </form>
								</div>
							@endif
							@if($question->block == true)
								<div>
									<form method="POST" action="{{ route('unblock.question', $question) }}">
			                            @csrf
			                            <x-dropdown-link :href="route('unblock.question', $question)"
			                                    onclick="event.preventDefault();
			                                                this.closest('form').submit();">
			                                        {{ __('unblock')}}
			                            </x-dropdown-link>
			                        </form>
								</div>
							@endif
						@endcan
						@auth()
							<div>
								<form method="POST" action="{{ route('follow.question', $question) }}">
		                            @csrf
		                            <x-dropdown-link :href="route('follow.question', $question)"
		                                    onclick="event.preventDefault();
		                                                this.closest('form').submit();">
		                                        {{ __('follow')}}
		                            </x-dropdown-link>
		                        </form>
							</div>
						@endif
					</div>
					<div class="asker">
						<div>
							<a href="{{ route('user.show', $question->user) }}">
								<img src="{{ $question->user->photo_path }}" style="width: 30%;"></th>
		      					<p>{{ $question->user->name }}</p>
	      					</a>
      					</div>
      					<div style="float: left;margin-right: 1%;">
      						<p>{{ $question->user->reputation }}</p>
      					</div>
					</div>
				</div>
				<div class="comments">
					<x-label for="name" :value="__('Comments:')" />
					@foreach($question->comments as $comment)
						<p>{{ $comment->text }}</p>
					@endforeach
				</div>
				@auth()
					@if($question->block == false)
						@livewire('show-comment-form', [$question])
					@endif
				@endif
			</div>
			<hr>

			<!-- Answeres -->
			<div class="answer">
				@foreach($question->answeres as $answere)
				<div class="answere-question">
					<div class="question-center">
						<div class="question-action">
							@livewire('answere-vote-and-accept', [$answere])
						</div>
						<div class="question-body markdown-body">
						{{ markdown($answere->body) }}
						</div>
					</div>
					<div class="question-asker">
						
						<div class="answerer">
							<div>
								<a href="{{ route('user.show', $answere->user) }}">
									<img src="{{ $answere->user->photo_path }}" style="width: 30%;"></th>
			      					<p>{{ $answere->user->name }}</p>
		      					</a>
	      					</div>
	      					<div style="float: left;margin-right: 1%;">
	      						<p>{{ $answere->user->reputation }}</p>
	      					</div>
						</div>
					</div>
					@can('update', $answere)
						<div class="actions">
							<div>
								<x-dropdown-link :href="route('answeres.edit', $answere)"
		                                    onclick="event.preventDefault();
		                                                this.closest('form').submit();">
		                                {{ __('edit')}}
		                        </x-dropdown-link>
							</div>
							<div>
								<form method="POST" action="{{ route('answeres.destroy', $answere) }}">
									@method('DELETE')
		                            @csrf
		                            <x-dropdown-link :href="route('answeres.destroy', $answere)"
		                                    onclick="event.preventDefault();
		                                                this.closest('form').submit();">
		                                        {{ __('delete')}}
		                            </x-dropdown-link>
		                        </form>
							</div>
						</div>
					@endcan
					<div class="comments">
						<x-label for="name" :value="__('Comments:')" />
						@foreach($answere->comments as $comment)
							<p>{{ $comment->text }}</p>
						@endforeach
					</div>
					@auth()
						@if($question->block == false)
							@livewire('answere-add-comment', [$answere])
						@endif
					@endif
				</div>
				<br><br><hr>
			@endforeach
			<br><br>
			@if($question->block == false)
				@auth()
					<div class="add-answere">
						<form method="POST" action="{{ route('add.answere', $question) }}">
							@csrf
							<div class="form-group">
							    <h2>Offer a new solution:</h2>
							    <br>
							    <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3" cols="80%" placeholder="Use markdown"></textarea>
							    <label>Use markdown</label>
							  </div>
							  <x-button class="ml-4 comment-button">
						            {{ __('Add solution') }}
						       </x-button>
						</form>
					</div>
				@endif
			@endif

			</div>
			</div>
@stop