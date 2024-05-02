@extends('layouts.backend.app')

@section('main_content')

<!-- Exportable Table -->

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header" style="display: flex; align-items: center; justify-content: space-between">
				<h2>
					ADMIN PROFILE
				</h2>
				<a href="{{ route('admin.profile.setting') }}" class="btn btn-success waves-effect"><i class="material-icons">settings</i> <span>Settings</span></a>
			</div>
			<div class="body">
				<div class="row clearfix">
					<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<div class="text-center">
							<img src="{{ url('storage/profile/'. Auth::user()->image) }}" class="img-thumbnail" style="width: 160px; height: 160px; border-radius: 50%" alt="{{ Auth::user()->name }}">
							<h3>{{ Auth::user()->name }}</h3>
							<h4><small>{{ Auth::user()->email }}</small></h4>
						</div>
					</div>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<label for="post">Admin Name</label>
						<div class="form-group">
							<div class="form-line">
								{{ Auth::user()->name }}
							</div>
						</div>
						<label for="post">Email Address</label>
						<div class="form-group">
							<div class="form-line">
								{{ Auth::user()->email }}
							</div>
						</div>
						<label for="post">About</label>
						<div class="form-group">
							<div class="form-line">
								{{ Auth::user()->email }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- #END# Exportable Table -->

@endsection