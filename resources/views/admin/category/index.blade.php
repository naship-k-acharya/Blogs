@extends('layouts.backend.app')

@section('main_content')

<!-- Exportable Table -->
<div class="block-header">
	<a href="{{ route('admin.category.create') }}" class="btn btn-danger waves-effect">
		<i class="material-icons">add</i>
		<span>Add Now Category</span>
	</a>
</div>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<div style="display:flex; align-items:center; justify-content: space-between">
					<h2> ALL CATEGORIES <span class="badge bg-pink">{{ $category->count() }}</span> </h2>
				</div>
			</div>
			<div class="body">
				<div class="table-responsive" style="padding-top: 6px">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>SL</th>
								<th>Category</th>
								<th>Post Count</th>
								<th>Slug</th>
								<th>Image</th>
								<th>Status</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>SL</th>
								<th>Category</th>
								<th>Post Count</th>
								<th>Slug</th>
								<th>Image</th>
								<th>Status</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>


							@foreach ($category as $key => $row)

							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $row->name }}</td>
								<td>{{ $row->posts->count() }}</td>
								<td>{{ $row->slug }}</td>
								<td>
									<img src="{{ asset('storage/category/'. $row->image) }}" class="img-thumbnail" width="60px"
										alt="{{ $row->name }}">
								</td>
								<td>
									@if ($row->status == 'active')
									<a href="{{ route('admin.category.active', $row->id) }}" class="btn badge bg-pink">Active</a>
									@else
									<a href="{{ route('admin.category.inactive', $row->id) }}" class="btn badge bg-grey">Inactive</a>
									@endif
								</td>

								<td>{{ date('d-M-Y', strtotime($row -> created_at)) }}</td>
								<td>
									<a href="{{ route('admin.category.edit', $row->id) }}" class="btn bg-green btn-xs waves-effect"><i
											class="material-icons">create</i></a>
									<a href="{{ route('admin.category.destroy', $row->id) }}" id="delete"
										class="btn btn-danger btn-xs waves-effect"><i class="material-icons">delete</i></a>
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