@extends('layouts.master')
@section('title','Message Logs')
@section('content')

<div class="container">
	{{-- <h3 class=" text-center">Messaging</h3> --}}
	<div class="messaging mt-3">
		<div class="inbox_msg">
			<div class="inbox_people">
				<div class="headind_srch">
					<div class="recent_heading">
						<h4>Recent</h4>
					</div>
					<div class="srch_bar">
						<div class="stylish-input-group">
							<input type="text" class="search-bar"  placeholder="Search" >
							<span class="input-group-addon">
								<button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
							</span> </div>
						</div>
					</div>
					<div class="inbox_chat">
						@foreach ($data as $item)
						<input type="hidden" id="logged_in_id" value="{{Auth::guard(get_guard())->user()->id}}">
						<input type="hidden" id="logged_in_guard" value="{{get_guard()}}">
						<div class="chat_list {{$item->id}}" id="{{$item->id}}" onclick="getMessages(this.id); return false;">
							<div class="chat_people">
								<div class="chat_img"> 
									@php
									$guard = get_guard();
									if($guard == 'mentor'){
										if(Auth::guard(get_guard())->user()->image =='')
										{
											$profileimg = "asset('design/images/mentor1.jpg')";
										}else{
											$profileimg = $item->opponent->image ; 
										}

									}elseif($guard == 'web'){
										$profileimg = $item->opponent->image ; 

								}

						@endphp
						<img src="{{$profileimg}}"> 
					</div>
					<div class="chat_ib">
						<h5>{{$item->opponent->name}} <span class="chat_date">{{$item->last_message->created_at->diffForHumans()}}</span></h5>
						<p>{{$item->last_message->message}}</p>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="mesgs">
		<div class="text-center">
			<h1>Mesages</h1>
		</div>
		{{-- <div class="msg_history">
			<div class="incoming_msg">
				<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
				<div class="received_msg">
					<div class="received_withd_msg">
						<p>Test which is a new approach to have all
						solutions</p>
						<span class="time_date"> 11:01 AM    |    June 9</span></div>
					</div>
				</div>
				<div class="outgoing_msg">
					<div class="sent_msg">
						<p>Test which is a new approach to have all
						solutions</p>
						<span class="time_date"> 11:01 AM    |    June 9</span> </div>
					</div>
				</div>
				<div class="type_msg">
					<div class="input_msg_write">
						<input type="text" class="write_msg" placeholder="Type a message" />
						<button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
					</div>
				</div> --}}
			</div>
		</div>
	</div>
</div>

@section('script')
<script type="text/javascript">
	function getMessages(id) {
		$("div.chat_list").removeClass("active_chat");
		$("div.chat_list."+id).addClass("active_chat");
		$.ajax({
			url: "{{route('get.messages.by.id')}}",
			type: 'POST',
			data: {
				'_token' : "{{csrf_token()}}",
				'conversation_id' : id
			},
			success:function(data) {
					// console.log(data.data);
					$('.mesgs').empty();
					var msg_history = '<div class="msg_history">';
					var type_msg = '';
					$.each(data.data, function(i, val) {
						if (($('#logged_in_id').val() == val.from_id) && ($('#logged_in_guard').val() == val.from_guard)) {
							msg_history += '<div class="outgoing_msg"><div class="sent_msg"><p>'+val.message+'</p><span class="time_date"> '+val.time+'</span> </div></div>';
						} else {
							msg_history += '<div class="incoming_msg"><div class="incoming_msg_img">'; 
							if (val.userDetails.image == '') {
								msg_history += "<img src={{asset('design/images/mentor1.jpg')}}>";
							} else {
								msg_history += "<img src='{{asset('')}}/'"+val.userDetails.image+">";
							}
							msg_history +='</div><div class="received_msg"><div class="received_withd_msg"><p>'+val.message+'</p><span class="time_date"> '+val.time+'</span></div></div></div>';
							msg_history += '<input type="hidden" id="receiverId" value="'+val.from_id+'">';
							msg_history += '<input type="hidden" id="receiverGuard" value="'+val.from_guard+'">';
							msg_history += '<input type="hidden" id="conversationId" value="'+val.conversation_id+'">';
						}
					})
					msg_history += '</div>';
					type_msg += "<div class='type_msg'><div class='input_msg_write'><form id='sendMessageForm'><input type='text' class='write_msg' placeholder='Type a message' id='my_message' value=''/><button class='msg_send_btn' type='submit'><i class='fa fa-paper-plane'></i></button></form></div></div>";
					$('.mesgs').append(msg_history);
					$('.mesgs').append(type_msg);
				}
			})
	};

	$(document).on('submit','#sendMessageForm',function(evt){
		var conversationId = $('#conversationId').val();
		evt.preventDefault();
		$.ajax({
			url: "{{route('send.message.universal')}}",
			type: "POST",
			data: {
				'_token': '{{csrf_token()}}',
				'receiverId': $('#receiverId').val(),
				'receiverGuard': $('#receiverGuard').val(),
				'senderId': $('#logged_in_id').val(),
				'senderGuard': $('#logged_in_guard').val(),
				'message': $('#my_message').val(),
			},
			success:function(data) {
				$('#sendMessageForm').trigger("reset");
				getMessages(conversationId);
			}
		})
	});
		// $('#sendMessageForm').submit(function(evt) {
			
		// });
		
	</script>
	@stop
	@endsection