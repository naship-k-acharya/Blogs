<section>
	<!-- Left Sidebar -->
	<aside id="leftsidebar" class="sidebar">
		<!-- User Info -->
		<div class="user-info" @if (Auth::check() && Auth::user()->role == 'admin')
			style="background: url({{ asset('backend') }}/images/user-img-background.jpg)" @else
			style="background: url({{ asset('backend') }}/images/user-img-background-author.jpg)" @endif>

			<div class="image">
				<img src="{{url('storage/profile/'. Auth::user()->image) }}" width="48" height="48"
					alt="{{ Auth::user()->name }}" />
			</div>
			<div class="info-container">
				<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}
				</div>
				<div class="email">{{ Auth::user()->email }}</div>
				<div class="btn-group user-helper-dropdown">
					<i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="true">keyboard_arrow_down</i>
					<ul class="dropdown-menu pull-right">
						<li><a @if (Auth::check() && Auth::user()->role == 'admin')
								href="{{ route('admin.profile.index') }}"
								@else
								{{-- href="{{ route('author.profile.index') }}" --}}
								@endif
								class=" waves-effect waves-block"><i class="material-icons">person</i>Profile</a></li>
						<li role="seperator" class="divider"></li>
						<li>
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- #User Info -->
		<!-- Menu -->

		@include('layouts.backend.layouts.admin')

		@include('layouts.backend.layouts.author')

		<!-- #Menu -->
		<!-- Footer -->
		@include('layouts.backend.layouts.footer')
		<!-- #Footer -->
	</aside>
	<!-- #END# Left Sidebar -->
</section>