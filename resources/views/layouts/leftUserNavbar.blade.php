<aside>
	<div class="leftNavbar" style="width: 100%;">
		<div>
			<a href="{{ route('setting', $user) }}" class="navLink">Setting</a>
		</div><hr>
		<div>
			<a href="{{ route('userQuestions', $user) }}" class="navLink">Questions</a>
		</div><hr>
		<div>
			<a href="{{ route('userAnsweres', $user) }}" class="navLink">Answeres</a>
		</div><hr>
		<div>
			<a href="{{ route('markedQuestions', $user) }}" class="navLink">Marked questions</a>
		</div><hr>
		@can('teach')
			<div>
				<a href="{{ route('show.lessons', $user) }}" class="navLink">Lessons</a>
			</div><hr>
		@endcan
		@can('write')
			<div>
				<a href="{{ route('show.articles', $user) }}" class="navLink">Articles</a>
			</div><hr>
		@endcan
		<div>
			<a href="{{ route('show.jobs', $user) }}" class="navLink">Jobs</a>
		</div><hr>
		<div>
			<a href="{{ route('showFollowers', $user) }}" class="navLink">Followers</a>
		</div><hr>
		<div>
			<a href="{{ route('showFollowing', $user) }}" class="navLink">Followings</a>
		</div><hr>
		<div>
			<form action="{{ route('logout') }}" method="POST">
				@csrf
				<button class="navLink">Logout</button>
			</form>
		</div><hr>
	</div>
</aside>