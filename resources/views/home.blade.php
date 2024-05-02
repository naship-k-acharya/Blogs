@extends('layouts.frontend.app')

@section('main_content')

<!--/banner-->
@push('css')
	

<style>
.slider-container {
    position: relative;
    width: 100%;
    max-width: 800px; /* Adjust as needed */
    margin: 0 auto;
    overflow: hidden;
}


.slider-wrapper {
    display: flex;
    animation: slideAnimation 20s infinite alternate; /* Adjust duration and timing function as needed */
    animation-play-state: running; /* Ensure animation is initially running */
}

.slider-slide {
    flex: 0 0 auto;
    width: 100%;
    height: 400px; /* Adjust as needed */
}

.slider-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.navigation {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
}

.navigation label {
    cursor: pointer;
    display: inline-block;
    width: 12px;
    height: 12px;
    margin: 0 5px;
    background: #bbb;
    border-radius: 50%;
}

.navigation label:hover {
    background: #333;
}

@keyframes slideAnimation {
	0% { transform: translateX(0); }
    20% { transform: translateX(0); } /* Start delay for 3 seconds */
    25% { transform: translateX(-100%); } /* Start sliding after delay */
    45% { transform: translateX(-100%); } /* Delay for 3 seconds */
    50% { transform: translateX(-200%); } /* Start sliding after delay */
    70% { transform: translateX(-200%); } /* Delay for 3 seconds */
    75% { transform: translateX(-300%); } /* Start sliding after delay */
    95% { transform: translateX(-300%); } /* Delay for 3 seconds */
    100% { transform: translateX(-300%); } /* Keep the last slide visible */
}


</style>
@endpush

<div class="slider-container mt-4">
  <h1 style="background-color:#eaf6fd "> POPULAR POSTS</h1>
    
    <div  class="slider-wrapper mt-3">
        @foreach($sliders as $index => $post)
            <div class="slider-slide" id="slide{{ $index + 1 }}">
                <img src="{{ url('storage/post/' . $post->image) }}" alt="{{ $post->title }}">
            </div>
        @endforeach
    </div>
    
    <div class="navigation">
        @foreach($sliders as $index => $post)
            <label for="slide{{ $index + 1 }}"></label>
        @endforeach
    </div>
</div>


<!--/model-->
<!--//banner-->
<!---728x90--->

<!---728x90--->
<!--/main-->
<section class="main-content-w3layouts-agileits">
	<div class="container">
		<div class="row">
			<!--left-->
			<div class="col-lg-8 left-blog-info-w3layouts-agileits text-left">
				<div class="blog-girds-sec">
					<div class="row border-bottom">

						@foreach ($posts as $post)

						<div class="col-lg-6 card">
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
							</div>
						</div>

						@endforeach

					</div>

					<div class="read text-center">
						<a href="{{ route('category') }}" class="btn btn-primary read-m">Read More</a>
					</div>

				</div>
			</div>
			<!--//left-->
			<!--right-->
			<aside style="background-color: #eaf6fd" class="col-lg-4 agileits-w3ls-right-blog-con text-right">
				<div class="right-blog-info text-left">

					<div class="tech-btm">
						<img src="{{ asset('frontend') }}/images/cloud.jpg" class="img-fluid" alt="">
					</div>
					<div class="tech-btm">
						@guest
							
					
						<h4>Sign up to our newsletter for daily update</h4>
						<p>keep updating for latest post here    </p>
						@else
						<p>keep updating for latest post here    </p>
						<form action="{{ route('subscriber.store') }}" method="post">
							@csrf
							<input type="hidden" name="email" value="{{ auth()->user()->email }}">

							<input type="submit" value="Subscribe" onclick="toastr.info('Subscribing.....', { progressBar: true })">
						</form>
						@endguest
					</div>

					<div class="tech-btm">
						<h4>Recent Posts</h4>

						@foreach ($recentPosts as $recentPost)

						<div class="blog-grids row mb-3 border-bottom pb-3">
							<div class="col-md-5 blog-grid-left">
								<a href="{{ route('post.destails', $post->slug) }}">
									<img src="{{ url('storage/post/thumbnail/' . $recentPost->image) }}" class="img-fluid"
										alt="{{ $recentPost->title }}" />
								</a>
							</div>
							<div class="col-md-7 blog-grid-right">
								<h5>
									<a href="{{ route('post.destails', $post->slug) }}">{{ $recentPost->title }}</a>
								</h5>
								<div class="sub-meta">
									<span> <i class="far fa-clock"></i> {{ $recentPost->created_at->format('d M, Y') }}</span>
								</div>
							</div>
						</div>

						@endforeach

					</div>
				</div>
			</aside>
			<!--//right-->
		</div>
	</div>
</section>
<!--//main-->

@endsection