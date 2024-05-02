@extends('layouts.backend.app')

@section('main_content')

<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<div style="display:flex; align-items:center; justify-content: space-between">
					<h2> ALL FAVORITE LIST <span class="badge bg-pink"></span></h2>
				</div>
			</div>
			<div class="body">
				<div class="table-responsive" style="padding-top: 6px">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>SL</th>
								<th>Title</th>
								<th>Favorite</th>
								<th>Post View</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>SL</th>
								<th>Title</th>
								<th>Favorite</th>
								<th>Post View</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>

							@foreach ($posts as $key => $post)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ Str::limit($post->title, 10, '...') }}</td>
								<td>{{ $post->favorite_users->count() }}</td>
								<td>{{ $post->view_count }}</td>
								<td>
									<a href="{{ route('favorite.remove', $post->id) }}" id="delete" class="btn btn-danger btn-xs waves-effect"> <i class="material-icons">delete</i> </a>
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