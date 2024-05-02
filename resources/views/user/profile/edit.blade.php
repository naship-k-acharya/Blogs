
@extends('user.layout')
@section('content')
<!-- Exportable Table -->

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					user PROFILE SETTINGS
				</h2>
			</div>
			<div class="body">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs tab-nav-right" role="tablist">
					<li role="presentation" class="active"><a href="#profile" data-toggle="tab" aria-expanded="true"> <i class="material-icons"></i> Update Profile</a>
					</li>
					<li role="presentation" class=""><a href="#password" data-toggle="tab" aria-expanded="false"> <i class="material-icons"></i> Change Password</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">

					<div role="tabpanel" class="tab-pane fade active in" id="profile">
						<form class="form-horizontal" action="{{ route('user.setting.update.profile') }}" method="post"
							enctype="multipart/form-data">
							@csrf
							@method('PUT')

							<div class="row clearfix">

								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="name">Name</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="text" id="name" name="name" class="form-control" placeholder="Enter your name"
												value="{{ Auth::user()->name }}">
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="email">Email Address</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="email" id="email" name="email" class="form-control"
												placeholder="Enter your email address" value="{{ Auth::user()->email }}">
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="image">Profile Image</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<img src="{{ url('storage/profile/' . Auth::user()	->image) }}"
												class="img-thumbnail" style="width: 160px" alt="{{ Auth::user()->name }}">
											<input type="file" id="image" name="image" class="form-control" placeholder="Enter choose image">
										</div>
									</div>
								</div>

							</div>
							<div class="row clearfix">
								<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
									<a href="{{ route('user.profile.index') }}" class="btn btn-danger m-t-10 waves-effect">BACK</a>
									<button type="submit" class="btn btn-primary m-t-10 waves-effect">UPDATE</button>
								</div>
							</div>
						</form>
					</div>

					<div role="tabpanel" class="tab-pane fade" id="password">
						<form class="form-horizontal" action="{{ route('user.setting.update.password') }}" method="post"
							enctype="multipart/form-data">
							@csrf
							@method('PUT')

							<div class="row clearfix">

								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="old_password">Old Password</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="password" id="old_password" name="old_password" class="form-control" placeholder="Enter your old password">
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="password">New Password</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="password" id="password" name="password" class="form-control"
												placeholder="Enter your new passowrd">
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="password_confirmation">Re-type Password</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Enter your confrom password">
										</div>
									</div>
								</div>

							</div>
							<div class="row clearfix">
								<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
									<a href="{{ route('user.profile.index') }}" class="btn btn-danger m-t-10 waves-effect">BACK</a>
									<button type="submit" class="btn btn-primary m-t-10 waves-effect">UPDATE</button>
								</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- #END# Exportable Table -->

@endsection