@extends ('layouts.master')
@yield('content')

@section('content')
	<div class="col-sm-8 blog-main">
		<h1> {{ $post->title  }} </h1>
		{{ $post->body  }}

		<hr>


			<div class="comments">
				<ul class="list-group">
					@foreach ($post->comments as $comment)
						<li class="list-group-item">
							<strong>
								{{ $comment->created_at->toFormattedDateString()}}: &nbsp;
							</strong>
							{{ $comment->body  }}
						</li>
						@endforeach
				</ul>
			</div>

			{{--add comment--}}
		<hr>

		<div class="card">
			<div class="card-block">
				<form method="POST" action="{!! route('posts.commentStore', [$post->id]) !!}">
					{!! csrf_field() !!}

					<div class="form-group">
						<textarea name="body" placeholder="Your comment here" class="form-control" required>
						</textarea>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Add comment</button>
					</div>
				</form>
				@include('layouts.errors')
			</div>
		</div>
	</div>

@endsection
