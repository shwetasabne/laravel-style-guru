@extends ('master.template')
@section('content')

	<section id="itemcreate" class="bg-light-gray">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1 text-left">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2 class="section-heading text-muted">Create a request</h2>
						</div>
						<div class="panel-body">
							<form class="form-horizontal" id="createForm" role="form" method="POST" action="/item">
							{{ csrf_field() }}

								<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
							        <label for="name" class="col-md-4 control-label label-heading text-muted">Title</label>
	                                <div class="col-md-6">
	                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">

	                                    @if ($errors->has('title'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('title') }}</strong>
	                                        </span>
	                                    @endif
	                                </div>
								</div>

								<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
							        <label for="description" class="col-md-4 control-label label-heading text-muted">Descriptions</label>
	                                <div class="col-md-6">
	                                    <textarea rows="2" id="description" type="text" class="form-control" name="description" value="{{ old('description') }}"></textarea>
	                                    @if ($errors->has('description'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('description') }}</strong>
	                                        </span>
	                                    @endif
	                                </div>
								</div>

								<div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
							        <label for="description" class="col-md-4 control-label label-heading text-muted">Categories</label>
	                                <div class="col-md-8">
	                                	@foreach($categories->chunk(3) as $row)
	                                		<div class="row">
	                                			@foreach($row as $cat)
	                                				<div class="col-xs-3">
	                                					<input name="categories_list[]" type="checkbox" id={{ $cat->id }} value={{ $cat->id }} />
	                                					<label for={{ $cat->id }}>{{ $cat->name }}</label>
	                                				</div>
	                                			@endforeach
	                                			<br/>
	                                		</div>
	                                	@endforeach
	                                </div>
								</div>

								<div class="form-group{{ $errors->has('occassions') ? ' has-error' : '' }}">
							        <label for="occassions" class="col-md-4 control-label label-heading text-muted">Occassions</label>
	                                <div class="col-md-8">
	                                	@foreach($occassions->chunk(3) as $row)
	                                		<div class="row">
	                                			@foreach($row as $occ)
	                                				<div class="col-xs-3">
	                                					<input name="occassions_list[]" type="checkbox" id={{ $occ->id }} value={{ $occ->id }} />
	                                					<label for={{ $occ->id }}>{{ $occ->name }}</label>
	                                				</div>
	                                			@endforeach
	                                			<br/>
	                                		</div>
	                                	@endforeach
	                                </div>
								</div>

								<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
									<label for="image" class="col-md-4 control-label label-heading text-muted">Upload Image</label>
									<div class="col-md-3">
								    	<div style="height:200px" id="cropContainerEyecandy"></div>
								    </div>
								</div>
								<br/>
								<div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="submitButton" class="btn btn-primary">
                                            Submit
                                        </button>
                                        <button id="clearButton" class="btn btn-primary pull-right">
                                            Clear
                                        </button>
                                    </div>
                                </div>
							</form>

							<div class="panel-footer">
                            	Having trouble creating a request ? Get in touch with us<a class="btn btn-link" href="{{ url('/contact') }}">here</a>and someone from our staff will reach out you!
                        	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="../plugins/croppic/croppic.min.js"></script>
	<script>
		/* croppic logic */
		var eyeCandy = $('#cropContainerEyecandy');
	    var croppedOptions = {
	        uploadUrl: '/image/upload',
	        cropUrl: '/image/crop',
	        cropData:{
	            'width' : eyeCandy.width(),
	            'height': eyeCandy.height()
	        }
	    };
    	var cropperBox = new Croppic('cropContainerEyecandy', croppedOptions);

    	/* clear form logic */
    	$("#clearButton").on('click', function(){
        	document.getElementById('createForm').reset();  
      	});	

      	/* submit form logic */
      	$('#submitButton').on('click', function(){
      		var filename = "";
      		filename = $('.croppedImg').attr('src');
      		if(filename === "" || filename === undefined){
      			alert('Please choose an image to get suggestions!');
      			return false;
      		}
      		$(this).append('<input type="hidden" name="image_path" value="'+ filename +'" /> ');
      		$('#createForm').submit();
      	});
	</script>
@stop