@extends('layouts.backend.app')

@section('main_content')

<!-- Exportable Table -->

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<div style="display:flex; align-items:center; justify-content: space-between">
					<h2> ALL COMMENTS <span class="badge bg-pink"> {{ $comments->count() }} </span> </h2>
				</div>
			</div>
			<div class="body">
				<div class="table-responsive" style="padding-top: 6px">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>Comment Info</th>
								<th>Post Info</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Comment Info</th>
								<th>Post Info</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>

							@foreach ($comments as $key => $comment)
							<tr>
								<td>
									<div class="media">
										<div class="media-left">
											<a href="javascript:void(0);">
												<img class="media-object img-thumbnail"
													src="{{ asset('storage/profile/' . $comment->user->image) }}"
													alt="{{ $comment->user->name }}" width="64" height="64">
											</a>
										</div>
										<div class="media-body">
											<div style="display: flex">
												<h4 class="media-heading">{{ $comment->user->name }} </h4>
												<span>&nbsp; at {{ $comment->created_at->diffForHumans() }}</span>
											</div>
											{{ $comment->message }}
										</div>
									</div>
								</td>

								<td>
									<div class="media">
										<div class="media-left">
											<a href="javascript:void(0);">
												<img class="media-object img-thumbnail"
													src="{{ url('storage/post/'. $comment->post->image) }}"
													alt="{{ $comment->post->title }}" width="64" height="64">
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">{{ Str::limit($comment->post->title, 30, '...') }}</h4>
											<span>by {{ $comment->user->name }}</span>
										</div>
									</div>
								</td>

								<td>
									<a href="{{ route('admin.comment.destroy', $comment->id) }}" id="delete" class="btn btn-danger btn-xs waves-effect"><i class="material-icons">delete</i></a>
									</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- #END# Exportable Table -->

@endsection