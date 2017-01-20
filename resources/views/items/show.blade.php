@extends ('master.template')
@section('content')
	<section id="itemsshow" class="bg-light-gray">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-lg-offset-3 text-center">
					<h3 class="section-heading text-muted">Suggestions</h3>
				</div>
			</div>
			<div class="row">

				<!-- Left panel -->
				<div class="col-lg-3 col-lg-offset-1 text-center">
					<div class="row">
						<div class="thumbnail">
							<img style="width: 100%" src="{{ $item->image_path }}">
						</div>
					</div>

					<!-- Image details -->
					<div class="row">
						<div class="panel panel-warning">
							<div class="panel-heading">
								<h5 class="section-heading text-muted">{{ $item->title }}</h5>
							</div>
							<div class="panel-body">
								<p class="text-left">
								{{ $item->description }}<br/>
								Looking for: {{ $item->categories }}<br/>
								Occassions: {{ $item->occassions }}</p>
							</div>
						</div>
					</div>

					<!-- User Details -->
					<div class="row">
						<div class="panel panel-warning">
							<div class="panel-heading">
								<h5 class="section-heading text-muted">User Details</h5>
							</div>
							<div class="panel-body">
								<p class="text-left">
									{{ $item->username }}
								</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Comments panel -->
				<div class="col-lg-6 col-lg-offset-1">
					<!-- Submit a comment -->
					<input type="hidden" id="token" value="{{ csrf_token() }}">
					<div class="row">
						<div class="form-group">
							<textarea id="comment" rows="2" type="text" class="form-control text-left" name="comment">
							</textarea>
						</div>
						<div class="form-group">
							@if(Auth::check())
							<button id="submitButton" class="btn btn-primary pull-right">
	                        	Submit
	                        </button>
							@else
							<button id="clearButton" class="btn btn-primary pull-right disabled" data-toggle="tooltip" data-placement="left" title="Please sign in/up to leave a comment">
	                        	Submit
	                        </button>
							@endif
						</div>
					</div>

					<div class="row space-top"></div>
					@foreach($item->comments as $comment)
						<!-- Show all the comments -->
						<div id="getcomments" class="row">
							<div class="well well-sm">
								<a href="http://www.w3schools.com">{{ $comment->comments_username }}</a>
								<p style="margin-bottom: 0px">{{ $comment->comment_text }}</p>
							</div>
						</div>
					@endforeach

				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script>
		$('#submitButton').click(function(){
			var commentVal = $('#comment').val();
			var itemId = <?php echo $item->id; ?>;
			if(commentVal === ""){
				return;
			}
			else{
				var html = "<div class='well well-sm'><p>" + commentVal + "</p></div>";
				var token = $('#token').val();
        		$.ajax({
        			url: '/comments',
        			headers: {'X-CSRF-TOKEN': token},
        			type: 'POST',
        			data: {
        				comment_text: commentVal,
        				item_id: itemId
        			},
        			success: function(data){
        				$("#getcomments").prepend(html);
        			},
        			error: function(data){
        				alert('Oops! Something went wrong.Please try again');
        			}
        		});
			}
		});
	</script>

@stop