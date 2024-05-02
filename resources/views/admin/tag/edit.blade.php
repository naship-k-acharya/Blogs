@extends('layouts.backend.app')

@section('main_content')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					EDIT TAG
				</h2>
			</div>
			<div class="body">
				<form action="{{ route('admin.tag.update', $tag->id) }}" method="post">
					@csrf

					<label for="tag">Tag Name</label>
					<div class="form-group m-b-100">
						<div class="form-line">
							<input type="text" id="tag" name="name" class="form-control" placeholder="Enter tag name" value="{{ $tag->name }}">
						</div>
						@error('name')
						<div class="text-danger" style="margin-top: 5px">{{ $message }}</div>
						@enderror

					</div>
					<a href="{{ route('admin.tag.index') }}" class="btn btn-danger m-t-10 waves-effect">BACK</a>
					<button type="submit" class="btn btn-primary m-t-10 waves-effect">UPDATE</button>

				</form>
			</div>
		</div>
	</div>
</div>


@endsection