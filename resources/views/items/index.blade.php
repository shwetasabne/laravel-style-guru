@extends ('master.template')
@section('content')

<section id="itemview" class="bg-light-gray">
	<form id="formget" role="form" method="GET" action="/item">
		<div class="container-fluid">

			<div class="row">

				<!-- Left Pane -->
				<div class="col-lg-3 text-center">
					<h5 style="text-align: left;">Filter Your Search</h5>
					<div class="well text-left" style="background-color: white">
						<div class="container">
							<div class="row">
								<a  href="#">Categories:</a>
								<div class = "row" style="padding-left:15px">
									<?php foreach ($categories as $category): ?>
										<div class="checkbox">
											<label>
												<input class="categories_list[]" name="<?php echo $category->id;?>" type="checkbox" value=""><?php echo $category->name;?>
											</label>
										</div>
									<?php endforeach; ?>
								</div>
							
								<a  href="#">Occassions:</a>
								<div class = "row" style="padding-left:15px">
									<?php foreach ($occassions as $occassion): ?>
										<div class="checkbox">
											<label>
												<input class="occassions_list[]" name="<?php echo $occassion->id;?>" type="checkbox" value=""><?php echo $occassion->name;?>
											</label>
										</div>
									<?php endforeach; ?>
								</div>

								<div class="form-group">
                                    <button id="submitButton" class="btn btn-primary">
                                        Go
                                    </button>
                                </div>
							</div>
						</div>
					</div>
				</div>

				<!-- Right pane -->
				<div class="col-lg-9 text-center">
					<div class="container">
						<div class="row">

							<div class="col-lg-4">
								<h5 style="text-align: left;">
									<span>Showing results: </span>
								</h5>
							</div>

							<div class = "col-lg-1">
							</div>

							<div class="col-lg-4">
								<h5 style="text-align: right;">
									<span>Sort By :</span>
									<select name="sortfield" style="font-family: 'Open Sans','Helvetica Neue',Arial,sans-serif; font-size:16px; font-weight:500">
			    						<option value="date_desc">Most recent</option>
			    						<option value="date_desc">Most talked</option>
				    				</select>
								</h5>
							</div>
						</div>
					</div>

					<div class="well" style="background-color: white">
						<div class="container">
							<div class="col-lg-10">
								@foreach (array_chunk($items->getCollection()->all(),3) as $row)
									<div class="row">
										@foreach($row as $item)
											<div class="col-md-3 itemclick">
												<a style="display:block" href="/item/{{ $item->id }}">
													<div id="<?php echo $item->id; ?>"class='thumbnail'>
														<img src="{{ $item->image_path }}" alt="{{ $item->title }}">
														<h5>{{ $item->title }}</h5>
													</div>
												</a>
											</div>
										@endforeach
									</div>
								@endforeach
							</div>
						</div>
						<div class="row">
							{!! $items->appends($request)->render() !!}
						</div>
					</div>
				</div>

			</div>
		</div>
	</form>
</section>
@stop