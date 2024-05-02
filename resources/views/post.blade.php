@extends('layouts.frontend.app')

@section('main_content')

<div class="banner-inner">
</div>
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="{{ route('home') }}">Home</a>
	</li>
	<li class="breadcrumb-item active">Single</li>
</ol>

<section class="banner-bottom">
	<!--/blog-->
	<div class="container">
		<!---728x90--->

		<div class="row">
			<!--left-->
			<div class="col-lg-8 left-blog-info-w3layouts-agileits text-left">
				<div class="blog-grid-top pb-0">
					<div class="b-grid-top">
						<div class="blog_info_left_grid">
							<a href="{{ route('post.destails', $post->slug) }}">
								<img src="{{url('storage/post/'.$post->image) }}" class="img-fluid"
									alt="{{ $post->title }}">
							</a>
						</div>
						<div class="blog-info-middle">
							<ul>
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
										{{ $post->favorite_users->count() }} Favorites </a>
									@endguest

								</li>
								<li class="mx-2">
									<a href="#">
										<i class="fas fa-eye"></i> {{ $post->view_count }} Views</a>
								</li>
								<li>
									<a href="#comments">
										<i class="far fa-comment"></i> {{ $post->comments ? $post->comments->count() : 0 }} Comments </a>
								</li>

							</ul>
						</div>
					</div>

					<h3>
						<a href="{{ route('post.destails', $post->slug) }}"> {{ $post->title }} </a>
					</h3>
					<p> {!! html_entity_decode($post->body) !!} </p>
				</div>

				<div class="comment-top mt-5" id="comments">
					<h4>Comments {{ $post->comments ? $post->comments->count() : 0 }} </h4>

					@if ($post->comments?->count() <= 0) <p class="text-danger">No Commnet yet. Be the first :</p>
						@else
						@foreach ($post->comments as $comment)
						<div style="gap: 2px; background-color:aliceblue" class="media mt-4">
							<img src="{{ url('storage/profile/' . $comment->user->image) }}"
							style="width:50px;height:50px;border-radius:50%;" alt="{{ $comment->user->name }}" class="img-fluid mr-3">
						
							<div class="media-body">
								<h5 class="mt-0">{{ $comment->user->name }} <span style="font-size: 14px; font-weight: normal"> on {{
										$comment->created_at->diffForHumans() }} </span></h5>
								<p> {{ $comment->message }} </p>
							</div>
							@if(Auth::check() && $comment->user_id == Auth::user()->id)
							<form action="{{ route('comment.delete', $comment->id) }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit"  class="btn btn-danger mt-2"><i class="fa fa-trash"></i></button>
							</form>
						@endif
						</div>
			<button class="btn btn-sm btn-info mt-2" onclick="toggleReplyForm({{ $comment->id }})">Reply</button>
			@guest
							<a href="javascript:void(0)" onclick="toastr.info('To like a comment, you need to login first!', '', { progressBar: true })">
								<i class="far fa-thumbs-up"></i> {{ $comment->likes()->count() }}
							</a>
						@else
							<a href="{{ route('comment.like', $comment->id) }}">
								<i class="far fa-thumbs-up {{ !Auth::user()->liked_comments->where('pivot.comment_id', $comment->id)->isEmpty() ? 'fas fa-thumbs-up' : '' }}"></i>
								{{ $comment->likes()->count() }} Likes
							</a>
						@endguest
            <form id="replyForm{{ $comment->id }}" style="display: none" action="{{ route('comment.reply', $comment->id) }}" method="POST" class="mt-2">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="reply_message" rows="2" placeholder="Write your reply here" required></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Submit Reply</button>
            </form>
			 @push('js')
			 <script>
				function toggleReplyForm(commentId) {
					var replyForm = document.getElementById('replyForm' + commentId);
					if (replyForm.style.display === 'none') {
						replyForm.style.display = 'block';
					} else {
						replyForm.style.display = 'none';
					}
				}
				function toggleMoreReplies(commentId) {
        var moreRepliesDiv = document.getElementById('moreReplies' + commentId);
        if (moreRepliesDiv.style.display === 'none') {
            moreRepliesDiv.style.display = 'block';
        } else {
            moreRepliesDiv.style.display = 'none';
        }
    }
			</script> @endpush


@if ($comment->replies->isNotEmpty())
<div style="margin-left: 50px; background-color: #f2f2f2; padding: 10px; border-radius: 5px;" class="mt-2">
	<p><strong>{{ $comment->replies->first()->user->name }}</strong> replied: {{ $comment->replies->first()->message }}</p>
	<span style="font-size: 12px;">{{ $comment->replies->first()->created_at->diffForHumans() }}</span>
</div>
@endif

<!-- View More Replies -->
@if ($comment->replies->count() > 1)
<div id="moreReplies{{ $comment->id }}" style="display: none;">
	@foreach ($comment->replies->slice(1) as $reply)
		<div style="margin-left: 50px; background-color: #f2f2f2; padding: 10px; border-radius: 5px;" class="mt-2">
			<p><strong>{{ $reply->user->name }}</strong> replied: {{ $reply->message }}</p>
			<span style="font-size: 12px;">{{ $reply->created_at->diffForHumans() }}</span>
		</div>
	@endforeach
</div>
<button class="btn btn-link" onclick="toggleMoreReplies({{ $comment->id }})">View more replies</button>
@endif
@endforeach
		@endif

				</div>

				<div class="comment-top mt-5">
					<h4>Leave a Comment</h4>
					<div class="comment-bottom mt-4">
						@guest
						<form>
							<input class="form-control mb-3" type="text" name="name" placeholder="Name">
							<input class="form-control mb-3" type="email" name="email" placeholder="Email">
							<textarea class="form-control mb-3" name="message" placeholder="Message..."></textarea>
							<a class="btn btn-dark px-5" href="{{ route('login') }}">Login</a>
							<p class="text-danger">For post a new comment. You need to login first*</p>
						</form>

						@else
						<form action="{{ route('comment.store', $post->id) }}" method="post">
							@csrf
							

							<textarea class="form-control mb-3" name="message" placeholder="Message..."></textarea>
							<button type="submit" class="btn btn-dark px-5">Submit</button>
						</form>
						@endguest
					</div>
				</div>
			</div>

			<!--//left-->
			<!--right-->
			<aside style="background-color:#eaf6fd " class="col-lg-4 agileits-w3ls-right-blog-con text-right">
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
						<h4>Categories</h4>
						<ul class="single nav">
							@foreach ($categories as $category)
							<li class="nav-list">
								<a class="btn btn-sm btn-info mx-1" href="{{ route('category.post', $category->slug) }}">{{ $category->name }} <span
										class="badge badge-warning badge-pill">{{
										$category->posts->count() }}</span></a>

							</li>
							@endforeach
						</ul>
					</div>
					<div class="tech-btm">
						<h4>Tags</h4>
						<ul class="single nav">
							@foreach ($tags as $tag)
							<li class="nav-list">
								<a class="btn btn-sm btn-primary mx-1" href="{{ route('tag.post', $tag->slug) }}">{{ $tag->name }} <span
										class="badge badge-warning badge-pill">{{
										$tag->posts->count() }}</span></a>
							</li>
							@endforeach
						</ul>
					</div>



					<div class="single-gd tech-btm">
						<h4>Recent Post</h4>


						@foreach ($recentPosts as $recentPost)

						<div class="blog-grids row mb-3 border-bottom pb-3">
							<div class="col-md-5 blog-grid-left">
								<a href="{{ route('post.destails', $recentPost->slug) }}">
									<img src="{{ url('storage/post/thumbnail/' . $recentPost->image) }}" class="img-fluid"
										alt="{{ $recentPost->title }}" />
								</a>
							</div>
							<div class="col-md-7 blog-grid-right">
								<h5>
									<a href="{{ route('post.destails', $recentPost->slug) }}">{{ $recentPost->title }}</a>
								</h5>
								<div class="sub-meta">
									<span> <i class="far fa-clock"></i> {{ $recentPost->created_at->diffForHumans() }}</span>
								</div>
							</div>
						</div>

						@endforeach


					</div>
				</div>

			</aside>
			<!--//right-->

			<div class="inner-sec border-top pt-5">
				<h4>Recommend by</h4>
				<!--left-->
				<div class="left-blog-info-w3layouts-agileits text-left mt-4">
					<div class="row">

						@foreach ($randomPosts as $randomPost)

						<div class="col-lg-4 card">
							<a href="{{ route('post.destails', $randomPost->slug) }}">
								<img src="{{ url('storage/post/thumbnail/' . $randomPost->image) }}"
									class="card-img-top img-fluid" alt="{{ $randomPost->title }}">
							</a>
							<div class="card-body">
								<ul class="blog-icons my-4">
									<li>
										<a href="#">
											<i class="far fa-calendar-alt"></i> {{ $randomPost->created_at->format('d M, Y') }}</a>
									</li>
									<li class="mx-2">
										<a href="#">
											<i class="far fa-comment"></i>{{ $post->comments ? $post->comments->count() : 0 }}</a>
									</li>
									<li>
										<a href="#">
											<i class="fas fa-eye"></i> {{ $post->view_count }}</a>
									</li>

								</ul>
								<h5 class="card-title">
									<a href="{{ route('post.destails', $randomPost->slug) }}">{{ $randomPost->title }}</a>
								</h5>
								<p class="card-text mb-3"> {!! Str::limit(strip_tags($randomPost->body), 70) !!} </p>
								<a href="{{ route('post.destails', $randomPost->slug) }}" class="btn btn-primary read-m">Read More</a>
							</div>
						</div>

						@endforeach
					</div>
					<!--//left-->
				</div>
			</div>

		</div>
	</div>
</section>

@endsection