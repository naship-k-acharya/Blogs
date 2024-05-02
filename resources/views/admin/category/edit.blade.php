@extends('layouts.backend.app')

@section('main_content')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					EDIT CETAGORY
				</h2>
			</div>
			<div class="body">
				<form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
					@csrf

					<label for="category">Tag Name</label>
					<div class="form-group m-b-100">
						<div class="form-line">
							<input type="text" id="category" name="name" class="form-control" placeholder="Enter category name"
								value="{{ $category->name }}">
						</div>
						@error('name')
						<div class="text-danger" style="margin-top: 5px">{{ $message }}</div>
						@enderror
					</div>

					<label for="image">Image</label>
					<div class="form-group">
						<div class="form-line">
							<img src="{{ asset('storage/category/'. $category->image) }}" class="img-thumbnail" width="200px" alt="{{ $category->name }}">
							<input type="file" id="image" name="image" class="form-control" placeholder="Enter choose image" >
						</div>
					</div>

					<a href="{{ route('admin.category.index') }}" class="btn btn-danger m-t-10 waves-effect">BACK</a>
					<button type="submit" class="btn btn-primary m-t-10 waves-effect">UPDATE</button>

				</form>
			</div>
		</div>
	</div>
</div>


@endsection