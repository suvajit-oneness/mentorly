@extends('layouts.master')
@section('title','Shift Available')
@section('content')
<section class="gray-wrapper">
	<div class="container">
		<div class="setting-wrapper">
			<div class="row m-0 mt-5">
				@include('mentor.settingSidebar')
				<div class="col-12 col-md-10 pl-2 pl-md-5">
					<div class="settings-details p-1" style="max-width: none;">
						<div class="table-responsive zoomTable">
							<form method="post" action="{{route('mentor.experience.log.update')}}">
								@csrf
								<table id="MyTable" class="table table-hover table-sm table-bordered">
									<thead>
										<tr>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Type</th>
											<th>College/University or Organisation</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@php $experience = $mentor->experience; @endphp
										@if(old('start'))
											@for( $i = 0; $i < count(old('start')); $i++) 
												<tr>
													<td><input type="date" name="start[]" onfocus="blur()" value="{{ old('start.'.$i)}}"></td>
													<td><input type="date" name="end[]" onfocus="blur()" value="{{ old('end.'.$i)}}"></td>
													<td>
														<select name="type[]" class="form-control">
															<option value="1">Education</option>
															<option value="2">Work Experince</option>
														</select>
													</td>
													<td><input type="text" name="name[]" class="form-control" value="{{ old('name.'.$i)}}" maxlength="255" placeholder="College/University or Organisation"></td>
													<td>
														@if(($i+1) == count(old('start')))
															<a href="javascript:void(0)" class="actionbtn addNew">
																<span class="text-success"><i class="fas fa-plus"></i></span>
															</a>
														@else
															<a href="javascript:void(0)" class="actionbtn remove">
																<span class="text-danger">&#10006;</span>
															</a>
														@endif
													</td>
												</tr>
											@endfor
										@elseif(count($experience) > 0)
											<?php $countExperience = count($experience); $j=0; ?>
											@foreach($experience as $key => $data)
												<?php $j++; ?>
												<tr>
													<td>
														<input type="date" name="start[]" onfocus="blur()" value="{{$data->start}}">
													</td>
													<td>
														<input type="date" name="end[]" onfocus="blur()" value="{{$data->end}}">
													</td>
													<td>
														<select name="type[]" class="form-control">
															<option value="1" @if($data->type == 1){{('selected')}}@endif>Education</option>
															<option value="2" @if($data->type == 2){{('selected')}}@endif>Work Experince</option>
														</select>
													</td>
													<td><input type="text" name="name[]" class="form-control" value="{{ $data->name}}" placeholder="College/University or Organisation" maxlength="255"></td>
													<td>
														@if(($j) == $countExperience)
															<a href="javascript:void(0)" class="actionbtn addNew">
																<span class="text-success"><i class="fas fa-plus"></i></span>
															</a>
														@else
															<a href="javascript:void(0)" class="remove">
																<span class="text-danger">&#10006;</span>
															</a>
														@endif
													</td>
												</tr>
											@endforeach
										@else
											<tr>
												<td>
													<input type="date" name="start[]" onfocus="blur()">
												</td>
												<td>
													<input type="date" name="end[]" onfocus="blur()">
												</td>
												<td>
													<select name="type[]" class="form-control">
														<option value="1">Education</option>
														<option value="2">Work Experince</option>
													</select>
												</td>
												<td><input type="text" name="name[]" class="form-control" maxlength="255" placeholder="College/University or Organisation"></td>
												<td>
													<a href="javascript:void(0)" class="actionbtn addNew">
														<span class="text-success"><i class="fas fa-plus"></i></span>
													</a>
												</td>
											</tr>
										@endif
									</tbody>
								</table>
								@if ($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
								<div class="form-group">
									<div class="row justify-content-center m-0">
										<div class="col-md-3 ">
											<div class="form-group text-center">
												<input type="submit" class="rounded-button-style" id="" value="Save">
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@section('script')
	<script type="text/javascript">
		$(document).on('click','.addNew',function(){
			$('.actionbtn').removeClass('addNew').addClass('remove');
			$('.remove').empty().append('<span class="text-danger">&#10006;</span>');
			var newRow = '<tr><td><input type="date" name="start[]" onfocus="blur()"></td><td><input type="date" name="end[]" onfocus="blur()"></td><td><select name="type[]" class="form-control"><option value="1">Education</option><option value="2">Work Experince</option></select></td><td><input type="text" name="name[]" class="form-control" maxlength="255" placeholder="College/University or Organisation"></td><td><a href="javascript:void(0)" class="actionbtn addNew"><span class="text-success"><i class="fas fa-plus"></i></span></a></td></tr>';
			$('#MyTable tr:last').after(newRow);
		});

		$(document).on('click','.remove',function(){
			$(this).closest('tr').remove();
		});
	</script>
@stop
@endsection