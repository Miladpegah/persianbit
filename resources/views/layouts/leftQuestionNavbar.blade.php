<aside>
	<div class="leftNavbar" style="width: 100%;">
		<div>
			<a href="{{ route('questions.index') }}" class="navLink">Questions</a>
		</div><hr>
		@auth()
			<div>
				<a href="{{ route('question.create') }}" class="navLink">Ask new question</a>
			</div><hr>
			<div>
				<a href="{{ route('my.questions', auth()->user()) }}" class="navLink">My questions</a>
			</div><hr>
		@endif
		<div>
			<a href="{{ route('solved.questions') }}" class="navLink">Solved questions</a>
		</div><hr>
		<div>
			<a href="{{ route('not.solved.questions') }}" class="navLink">NOT Solved questions</a>
		</div><hr>
		<div>
			<a href="{{ route('blocked.question') }}" class="navLink">Blocked questions</a>
		</div><hr>
		@auth()
			<div>
				<a href="{{ route('marked.question', auth()->user()) }}" class="navLink">Marked questions</a>
			</div><hr>
		@endif
		<div>
			<a href="{{ route('terent.questions') }}" class="navLink">Terents</a>
		</div><hr>
		<div>
			<a href="{{ route('answereless.question') }}" class="navLink">Answerelesses
			</a>
		</div><hr>
		@auth()
			<div>
				<form action="{{ route('logout') }}" method="POST">
					@csrf
					<button class="navLink">Logout</button>
				</form>
			</div><hr>
		@endif
	</div>
</aside>