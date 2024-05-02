@extends('layouts.backend.app')

@section('main_content')

<div class="block-header">
	<h2>DASHBOARD</h2>
</div>

<!-- Widgets -->
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-blue ">
			<div class="icon">
				<i class="material-icons">playlist_add_check</i>
			</div>
			<div class="content">
				<div class="text">TOTAL POSTS</div>
				<div class="number count-to" data-from="0" data-to="{{ $posts->count() }}" data-speed="1000"
					data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-brown ">
			<div class="icon">
				<i class="material-icons">favorite</i>
			</div>
			<div class="content">
				<div class="text">FAVORITES</div>
				<div class="number count-to" data-from="0" data-to=" 12" data-speed="1000" data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-indigo ">
			<div class="icon">
				<i class="material-icons">forum</i>
			</div>
			<div class="content">
				<div class="text">COMMENTS</div>
				<div class="number count-to" data-from="0" data-to="{{ $comments->count() }}" data-speed="1000"
					data-fresh-interval="20"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-green ">
			<div class="icon">
				<i class="material-icons">person</i>
			</div>
			<div class="content">
				<div class="text">TOTAL userS</div>
				<div class="number count-to" data-from="0" data-to="{{ $user_count }}" data-speed="1000"
					data-fresh-interval="20">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- #END# Widgets -->

<div class="row clearfix">

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-indigo ">
			<div class="icon">
				<i class="material-icons">select_all</i>
			</div>
			<div class="content">
				<div class="text">PENDING POSTS</div>
				<div class="number count-to" data-from="0" data-to="{{$pending_posts}}" data-speed="1000"
					data-fresh-interval="20"> {{ $pending_posts }}
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-amber ">
			<div class="icon">
				<i class="material-icons">visibility</i>
			</div>
			<div class="content">
				<div class="text">TOTAL VIEWS</div>
				<div class="number count-to" data-from="0" data-to="{{ $all_post_views }}" data-speed="1000"
					data-fresh-interval="20">
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-purple ">
			<div class="icon">
				<i class="material-icons">apps</i>
			</div>
			<div class="content">
				<div class="text">TOTAL CATEGORIES</div>
				<div class="number count-to" data-from="0" data-to="{{ $categories_count }}" data-speed="1000"
					data-fresh-interval="20">
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-red ">
			<div class="icon">
				<i class="material-icons">tag</i>
			</div>
			<div class="content">
				<div class="text">TOTAL TAGS</div>
				<div class="number count-to" data-from="0" data-to="{{ $tags_count }}" data-speed="1000"
					data-fresh-interval="20">
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
				<div class="info-box bg-deep-orange ">
					<div class="icon">
						<i class="material-icons">today</i>
					</div>
					<div class="content">
						<div class="text">TODAY USERS</div>
						<div class="number count-to" data-from="0" data-to="{{ $new_user_today }}" data-speed="1000"
							data-fresh-interval="20">
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>

	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<div class="row clearfix">
					<div class="col-xs-12 col-sm-6">
						<h2 class="text-uppercase">TOP 5 POPULER POSTS</h2>
					</div>
				</div>
			</div>
			<div class="body">
				<table class="table table-bordered table-striped table-hover dataTable">
					<thead>
						<tr>
							<th>Rank List</th>
							<th>Titlel</th>
							<th>Views</th>
							<th>Favorites</th>
							<th>Comments</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($popular as $key=>$row)
						<tr>
							<td>{{ $key+ 1 }}</td>
							<td>{{ Str::limit($row->title, 20, '...') }}</td>
							<td>{{ $row->view_count }}</td>
							<td>{{ $row->favorite_users_count }}</td>
							<td>{{ $row->comments_count }}</td>
							<td>
								@if ($row->status == 'active' && $row->is_approved == 'true')
								<span class="btn btn-xs btn-success">Published</span>
								@else
								<span class="btn btn-xs btn-danger">Pending..</span>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<div class="row clearfix">
					<div class="col-xs-12 col-sm-6">
						<h2 class="text-uppercase">TOP 10 ACTIVE userS</h2>
					</div>
				</div>
			</div>
			<div class="body">
				<table class="table table-bordered table-striped table-hover dataTable">
					<thead>
						<tr>
							<th>Rank List</th>
							<th>Name</th>
							<th>Email</th>
							
							<th>Comments</th>
							<th>Favorite Posts</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($active_user as $key=>$user)
						<tr>
							<td>{{ $key+ 1 }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->favorite_posts_count }}</td>
							<td>{{ $user->comments_count }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<h1>AUTHOR TABLE HERE</h1>
			</div>
		</div>
	</div>
</div>

@endsection