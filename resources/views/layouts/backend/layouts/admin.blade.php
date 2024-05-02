@if (Request::is('admin*'))
<div class="menu">
	<ul class="list">
		<li class="header">MAIN NAVIGATION</li>
		<li class="{{ Request()->is('admin/dashboard') ? 'active' : '' }}">
			<a href="{{ route('admin.dashboard') }}">
				<i class="material-icons">home</i>
				<span>Home</span>
			</a>
		</li>
		<li class="{{ Request()->is('admin/tag*') ? 'active' : '' }}">
			<a href="{{ route('admin.tag.index') }}">
				<i class="material-icons">tag</i>
				<span>Tag</span>
			</a>
		</li>
		<li class="{{ Request()->is('admin/category*') ? 'active' : '' }}">
			<a href="{{ route('admin.category.index') }}">
				<i class="material-icons">apps</i>
				<span>Category</span>
			</a>
		</li>
		<li class="{{ Request()->is('admin/post*') ? 'active' : '' }}">
			<a href="{{ route('admin.post.index') }}">
				<i class="material-icons">library_books</i>
				<span>Post</span>
			</a>
		</li>
		<li class="{{ Request()->is('admin/pendding/post') ? 'active' : '' }}">
			<a href="{{ route('admin.post.pendding') }}">
				<i class="material-icons">select_all</i>
				<span>Pendding Post</span>
			</a>
		</li>
		<li class="{{ Request()->is('admin/subscriber*') ? 'active' : '' }}">
			<a href="{{ route('subscriber.index') }}">
				<i class="material-icons">subscriptions</i>
				<span>Subscribers</span>
			</a>
		</li>
		{{-- <li class="{{ Request()->is('admin/slider*') ? 'active' : '' }}">
			<a href="{{ route('slider.index') }}">
				<i class="material-icons">queue</i>
				<span>Sliders</span>
			</a> --}}
		{{-- </li> --}}
		 <li class="{{ Request()->is('admin/favorite*') ? 'active' : '' }}">
			<a href="{{ route('admin.favorite.index') }}">
				<i class="material-icons">favorite</i>
				<span>Favorite Posts</span>
			</a>
		</li>
		<li class="{{ Request()->is('admin/comment*') ? 'active' : '' }}">
			<a href="{{ route('admin.comment.index') }}">
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