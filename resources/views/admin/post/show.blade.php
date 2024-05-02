@extends('layouts.backend.app')

@section('main_content')

{{-- <div class="block-header bg-blue"
	style="padding: 8px 12px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12)">
	<div class="" style="display: flex; align-items: center;">
		<i class="material-icons">library_books</i>
		<span>&nbsp; Post</span>
	</div>
</div> --}}

<!-- Exportable Table -->
<div class="block-header" style="display: flex; align-items: center; justify-content: space-between">
	@if ($post->is_approved == 'false')
	<a href="{{ route('admin.post.pendding') }}" class="btn btn-danger waves-effect">
		<i class="material-icons">arrow_back</i>
		<span>BACK</span>
	</a>
	@else
	<a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect">
		<i class="material-icons">arrow_back</i>
		<span>BACK</span>
	</a>
	@endif


	@if ($post->status == 'active')
	<button disabled class="btn btn-success waves-effect"> <i class="material-icons">check</i>
		<span>Approved</span></button>
	@else
	<a href="{{ route('admin.post.inactive', $post->id) }}" class="btn btn-warning waves-effect"><i
			class="material-icons">call_made</i> <span>Pendding..</span></a>
	@endif

</div>

<div class="row clearfix">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<div class="card">
			<div class="header">
				<h2> {{ $post->title }} </h2>
				<small>Posted By <strong> <a href="">{{ $post->user->name }}</a> </strong> on
					{{ $post->created_at->format('d-M-Y') }} at {{ $post->created_at->format('h:i A') }} </small>
			</div>
			<div class="body">
				{!! $post->body !!}
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="card">
			<div class="header bg-cyan">
				<h2>
					Categories
				</h2>
			</div>
			<div class="body">

				@foreach ($category as $categories)
				<span class="bg-cyan" style="padding: 4px 8px; display: inline-block">{{ $categories->name }}</span>
				@endforeach

			</div>
		</div>

		<div class="card">
			<div class="header bg-green">
				<h2>
					Tags
				</h2>
			</div>
			<div class="body">

				@foreach ($tag as $tags)
				<span class="bg-green" style="padding: 4px 8px; display: inline-block">{{ $tags->name }}</span>
				@endforeach

			</div>
		</div>


		<div class="card">
			<div class="header bg-purple">
				<h2>
					Featured Image
				</h2>
			</div>
			<div class="body">
				<img src="{{url('storage/post/'.$post->image) }}" class="img-thumbnail" width="320px"
					alt="{{ $post->title }}">
			</div>
		</div>

	</div>

</div>
<!-- #END# Exportable Table -->

@endsection