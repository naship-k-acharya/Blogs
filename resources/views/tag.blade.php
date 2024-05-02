@extends('layouts.frontend.app')

@push('css')
<style>
	.noMatch {
		text-align: center !important;
	}
</style>
@endpush

@section('main_content')

<section class="main-content-w3layouts-agileits">
	<div class="container">
		<!---728x90--->

		<h3 class="tittle">{{ $tags->name }} All Posts</h3>
		<!---728x90--->
		<div class="inner-sec">
			<!--left-->
			<div class="left-blog-info-w3layouts-agileits text-left">
				<div class="row">

					@if ($posts->count() > 0)
					@foreach ($posts as $post)

					<div class="col-lg-4 card">
						<a href="{{ route('post.destails', $post->slug) }}">
							<img src="{{ url('storage/post/' . $post->image) }}"
								class="card-img-top img-fluid" alt="{{ $post->title }}">
						</a>
						<div class="card-body">
							<ul class="blog-icons my-4">
								<li>
									<a href="#">
										<i class="far fa-calendar-alt"></i> {{ $post->created_at->format('d M, Y') }}</a>
								</li>
								<li class="mx-2">
									@guest
									<a href="javascript:void(0)"
										onclick="toastr.info('To add favorite list. You need to login first!', '', { progressBar: true })">
										<i class="far fa-heart"></i> {{ $post->favorite_users->count() }} </a>
									@else
									<a href="{{ route('post.favorite', $post->id) }}"><i
											class="far fa-heart {{ !Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0 ? 'fas fa-heart' : '' }}"></i>
										{{ $post->favorite_users->count() }} </a>
									<form id="favorite-form-{{ $post->id }}" action="{{ route('post.favorite', $post->id) }}"
										method="post" style="display: none">
										@csrf
									</form>
									@endguest
								</li>
								<li class="mx-2">
									<a href="#">
										<i class="far fa-comment"></i> {{ $post->comments ? $post->comments->count() : 0 }}</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-eye"></i> {{ $post->view_count }}</a>
								</li>

							</ul>
							<h5 class="card-title">
								<a href="{{ route('post.destails', $post->slug) }}">{{ $post->title }}</a>
							</h5>
							<p class="card-text mb-3"> {!! Str::limit(strip_tags($post->body), 70) !!} </p>
							<a href="{{ route('post.destails', $post->slug) }}" class="btn btn-primary read-m">Read More</a>
						</div>
					</div>

					@endforeach
					@else
					<div class="col-lg-12 card noMatch">
						<h6 class="text-danger m-0">Sorry, No Post Match!</h6>
					</div>
					@endif

				</div>
				<!--//left-->
				{{-- {{ $tags->links() }} --}}

			</div>
		</div>
	</div>
</section>

@endsection