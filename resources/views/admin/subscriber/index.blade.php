@extends('layouts.backend.app')

@section('main_content')

<!-- Exportable Table -->

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<div style="display:flex; align-items:center; justify-content: space-between">
					<h2> ALL SUBSCRIBERS <span class="badge bg-pink">{{ $subscriber->count() }}</span></h2>
				</div>
			</div>
			<div class="body">
				<div class="table-responsive" style="padding-top: 6px">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>SL</th>
								<th>Email</th>
								<th>Create At</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>SL</th>
								<th>Email</th>
								<th>Create At</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>


							@foreach ($subscriber as $key => $row)

							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $row->email }}</td>
								<td>{{ $row->created_at->format('d-M-Y') }} at {{ $row->created_at->format('h:i A') }}</td>

								<td>
									<a href="{{ route('subscriber.destroy', $row->id) }}" id="delete"
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