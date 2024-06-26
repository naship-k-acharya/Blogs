<header>
	<div class="top-bar_sub_w3layouts container-fluid">
		<div class="row">
			<div class="col-md-4 logo text-left">
				<a class="navbar-brand" href="{{ route('home') }}"> <i class="fab fa-linode"></i> completeUI</a>
			</div>
			<div class="offset-md-4 col-md-4 log-icons text-right">
				<ul class="social_list1 mt-3 mb-2">
					<li>
						<a href="#" class="facebook1 mx-2">
							<i class="fab fa-facebook-f"></i>
						</a>
					</li>
					<li>
						<a href="#" class="twitter2">
							<i class="fab fa-twitter"></i>
						</a>
					</li>
					<li>
						<a href="#" class="dribble3 mx-2">
							<i class="fab fa-dribbble"></i>
						</a>
					</li>
					<li>
						<a href="#" class="pin">
							<i class="fab fa-pinterest-p"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="header_top" id="home">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<button class="navbar-toggler navbar-toggler-right mx-auto my-3" type="button" data-toggle="collapse"
				data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item {{ Request()->is('/') ? 'active' : '' }}">
						<a class="nav-link" href="{{ route('home') }}">Home
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="about.html">About</a>
					</li>
					{{-- <li class="nav-item {{ Request()->is('category') ? 'active' : '' }}">
						<a class="nav-link" href="{{ route('category') }}">Categories</a>
					</li> --}}
					{{-- <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false"> Categories </a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#"></a>
							<a class="dropdown-item" href="blog1.html">Standard Blog</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="blog2.html">2 Column Blog</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="blog3.html">3 Column Blog</a>
						</div>
					</li> --}}
					<li class="nav-item">
						<a class="nav-link" href="contact.html">Contact</a>
					</li>
				</ul>
				{{-- <form action="{{ route('search') }}" method="GET" class="form-inline my-2 mr-4 my-lg-0 header-search">
					<input class="form-control mr-sm-2" type="search" placeholder="Search here..." name="query" value="{{ isset($query) ? $query : '' }}" />
					<button class="btn btn1 my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
				</form> --}}


				<span>
					@if (Auth::check() && Auth::user()->role == 'admin')
					<a href="{{ route('admin.dashboard') }}" class="btn px-0 px-md-auto" style="color: #01cd74"> <i class="fas fa-user"></i> My Account </a>
					@elseif (Auth::check() && Auth::user()->role == 'author')
					<a href="{{ route('author.dashboard') }}" class="btn px-0 px-md-auto" style="color: #01cd74"> <i class="fas fa-user"></i> My Account </a>
					@elseif (Auth::check() && Auth::user()->role == 'user')
					<a href="{{ route('user.profile.index') }}" class="btn px-0 px-md-auto" style="color: #01cd74"> <i class="fas fa-user"></i> My Account </a>
					@else
					<a href="{{ route('login') }}" class="btn px-0 px-md-auto" style="color: #01cd74"> <i class="fas fa-lock"></i> Sign In </a>
					@endif
				</span>
			</div>
		</nav>
	</div>
</header>