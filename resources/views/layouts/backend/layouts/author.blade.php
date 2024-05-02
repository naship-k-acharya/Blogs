@if (Request::is('author*'))
<div class="menu">
	<ul class="list">
		<li class="header">MAIN NAVIGATION</li>
		<li class="{{ Request()->is('author/dashboard') ? 'active' : '' }}">
			<a href="{{ route('author.dashboard') }}">
				<i class="material-icons">home</i>
				<span>Home</span>
			</a>
		</li>
		<li class="{{ Request()->is('author/post*') ? 'active' : '' }}">
			<a href="{{ route('post.index') }}">
				<i class="material-icons">library_books</i>
				<span>Post</span>
			</a>
		</li>
		<li class="{{ Request()->is('author/favorite*') ? 'active' : '' }}">
			<a href="{{ route('author.favorite.index') }}">
				<i class="material-icons">favorite</i>
				<span>Favorite Posts</span>
			</a>
		</li>
		<li class="{{ Request()->is('author/comment*') ? 'active' : '' }}">
			<a href="{{ route('author.comment.index') }}">
				<i class="material-icons">forum</i>
				<span>Comments</span>
			</a>
		</li>
		<li class="header">SYSTEMS</li>
		<li>
			<a href="{{ route('logout') }}" onclick="event.preventDefault();
			document.getElementById('logout-form').submit();">
				<i class="material-icons">power_settings_new</i>
				<span>Logout</span>
			</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
				@csrf
			</form>
		</li>

	</ul>
</div>
@endif