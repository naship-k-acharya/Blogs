@extends('layouts.backend.app')

@push('css')
<!-- Latest compiled and minified CSS -->
<link href="{{ asset('backend') }}/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
@endpush

@section('main_content')

<form action="{{ route('admin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
	@csrf

	<div class="row clearfix">

		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						EDIT POST
					</h2>
				</div>
				<div class="body">

					<label for="post">Post Title</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" id="title" name="title" class="form-control" placeholder="Enter post title"
								value="{{ $post->title }}">
						</div>
					</div>

					<label for="image">Choose Image</label>
					<div class="form-group">
						<div class="form-line">
							<img src="{{ asset('storage/post/'. $post->image) }}" class="img-thumbnail" width="200px"
								alt="{{ $post->title }}">
							<input type="file" id="image" name="image" class="form-control" placeholder="Enter choose image">
						</div>
					</div>

					<div class="form-group">
						<input type="checkbox" id="publish" name="status" class="filled-in" value="active" {{ $post->status ==
						'active' ? 'checked' : '' }}>
						<label for="publish">Published</label>
					</div>

				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						CATEGORY AND TAG
					</h2>
				</div>
				<div class="body">

					<div class="form-group form-float">
						<div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
							<label>Category Selected</label>
							<select class="form-control show-tick" name="categories[]" id="category" data-live-search="true"
								multiple="">
								@foreach ($category as $row)
								<option @foreach ($post->category as $item)
									{{ $item->id == $row->id ? 'selected' : '' }}
									@endforeach

									value="{{ $row->id }}">{{ $row->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group form-float">
						<div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
							<label>Tag Selected</label>
							<select class="form-control show-tick" name="tags[]" id="tag" data-live-search="true" multiple="">
								@foreach ($tag as $row)
								<option @foreach ($post->tag as $item)
									{{ $item->id == $row->id ? 'selected' : '' }}
									@endforeach

									value="{{ $row->id }}">{{ $row->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<a href="{{ route('admin.post.index') }}" class="btn btn-danger m-t-10 waves-effect">BACK</a>
					<button type="submit" class="btn btn-primary m-t-10 waves-effect">UPDATE</button>
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						BODY
					</h2>
				</div>
				<div class="body">
					<textarea name="body" id="defultTINYmce">{{ $post->body }}</textarea>
				</div>
			</div>
		</div>

	</div>
</form>

@endsection

@push('script')
<!-- Latest compiled and minified JavaScript -->
<script src="{{ asset('backend') }}/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>

<!-- TinyMCE -->
<script src="{{ asset('backend') }}/plugins/tinymce/tinymce.jquery.min.js"></script>

<script>
	tinymce.init({
		selector: "textarea#defultTINYmce",
		theme: "modern",
		height: 300,
		plugins: [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools'
		],
		toolbar1: 'insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons',
		image_advtab: true,
	});

</script>

@endpush