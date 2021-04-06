@extends('layouts.master')
@section('title','Shift Available')
@section('content')
<section class="gray-wrapper">
	<div class="setting-wrapper">
		@include('mentor.settingSidebar')
		<div class="settings-details">
			<form method="post" action="{{route('mentor.availability.setting.save')}}">
				@csrf
				<table id="MyTable" class="table" border="1" style="width: 100%">
					<thead>
						<tr>
							<th rowspan="3">Date</th>
							<th>Time Shift</th>
							<th>Available</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if(old('date'))
							@for( $i = 0; $i < count(old('date')); $i++) 
								<tr>
									<td><input type="date" name="date[]" onfocus="blur()" value="{{ old('date.'.$i)}}"></td>
									<td><input type="time" name="time[]" onfocus="blur()" value="{{ old('time.'.$i)}}"></td>
									<td>
										<input type="checkbox" class="checkboxbtn" @if(old('available.'.$i)){{('checked')}}@endif>
										<input type="hidden" name="available[]" value="{{ old('available.'.$i)}}">
									</td>
									<td>
										@if(($i+1) == count(old('date')))
											<a href="javascript:void(0)" class="actionbtn addNew">
												<span class="text-success">&#x2b;</span>
											</a>
										@else
											<a href="javascript:void(0)" class="actionbtn remove">
												<span class="text-danger">&#10006;</span>
											</a>
										@endif
									</td>
								</tr>
							@endfor
						@elseif(count($timeShift) > 0)
							<?php $countTimeShift = count($timeShift); $j=0; ?>
							@foreach($timeShift as $key => $data)
								<?php $j++; ?>
								<tr>
									<td>
										<input type="date" name="date[]" onfocus="blur()" value="{{$data->date}}" @if($data->available == 2){{('disabled')}}@endif>
									</td>
									<td>
										<input type="time" name="time[]" onfocus="blur()" value="{{$data->time_shift}}" @if($data->available == 2){{('disabled')}}@endif>
									</td>
									<td>
										<input type="checkbox" class="checkboxbtn" @if($data->available >0){{('checked')}}@endif @if($data->available == 2){{('disabled')}}@endif>
										@if($data->available == 2){{('Booked')}}@endif
										<input type="hidden" name="available[]" value="{{$data->available}}" @if($data->available == 2){{('disabled')}}@endif>
									</td>
									<td>
										@if(($j) == $countTimeShift)
											<a href="javascript:void(0)" class="actionbtn addNew">
												<span class="text-success">&#x2b;</span>
											</a>
										@else
											<a href="javascript:void(0)" class="@if($data->available != 2){{'remove'}}@endif">
												<span class="text-danger">&#10006;</span>
											</a>
										@endif
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td><input type="date" name="date[]" onfocus="blur()"></td>
								<td><input type="time" name="time[]" onfocus="blur()"></td>
								<td>
									<input type="checkbox" class="checkboxbtn" checked>
									<input type="hidden" name="available[]" value="1">
								</td>
								<td>
									<a href="javascript:void(0)" class="actionbtn addNew">
										<span class="text-success">&#x2b;</span>
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
					<div class="row align-items-center">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="form-group">
				  				<input type="submit" class="rounded-button-style" id="" value="Save settings">
				  			</div>
				  		</div>
					</div>
				</div>
			</form>
		</div>

	</div>
</section>

@section('script')
	<script type="text/javascript">
		$(document).on('click','.addNew',function(){
			$('.actionbtn').removeClass('addNew').addClass('remove');
			$('.remove').empty().append('<span class="text-danger">&#10006;</span>');
			var newRow = '<tr><td><input type="date" onfocus="blur()" name="date[]"></td><td><input type="time" onfocus="blur()" name="time[]"></td>';
			newRow += '<td><input type="checkbox" class="checkboxbtn" checked><input type="hidden" name="available[]" value="1"></td>'
			newRow += '<td><a href="javascript:void(0)" class="actionbtn addNew">&#x2b;</a></td></tr>';
			$('#MyTable tr:last').after(newRow);
		});

		$(document).on('click','.remove',function(){
			$(this).closest('tr').remove();
		});

		$(document).on('click','.checkboxbtn',function(){
			thisCheckbox = $(this);
			var inputValue = 0;
			if (thisCheckbox.prop('checked')==true){
				inputValue = 1;
			}
			thisCheckbox.closest('td').find('input').val(inputValue);
		});
	</script>
@stop
@endsection