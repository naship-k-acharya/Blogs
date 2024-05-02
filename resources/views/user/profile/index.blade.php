
@extends('user.layout')
@section('content')
<!-- Exportable Table -->

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			
			<div class="body">
				<div class="row clearfix">
					<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
						
						<div class="text-center">
							<img src="{{ url('storage/profile/' . Auth::user()->image) }}" class="img-thumbnail" style="width: 160px; height: 160px; border-radius: 50%" alt="{{ Auth::user()->name }}">
							<h3>{{ Auth::user()->name }}</h3>
							<h4><small>{{ Auth::user()->email }}</small></h4>
						</div>
					</div>
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<label for="post">user Name</label>
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
						<a href="{{ route('user.profile.setting') }}" class="btn btn-success waves-effect"><i class="material-icons">settings</i> </a>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- #END# Exportable Table -->

@endsection