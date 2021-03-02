@extends('layouts.master')
@section('title','mentors')
@section('content')

<section class="gray-wrapper">
	<div class="setting-wrapper">
		<ul class="setting-list">
			<li><a href="{{route('mentor.mentee.setting')}}" class="active">Account</a></li>
			<li><a href="#">Email</a></li>
			<li><a href="#">Password </a></li>
			<li><a href="#">Payment Methods</a></li>
			<li><a href="#">Payment History</a></li>
			<li><a href="#">Calendar</a></li>
		</ul>
		<div class="settings-details">
			<form>
				<div class="settings-heading">Account Settings</div>

				<h4 class="small-heading">Profile image</h4>

				<div class="profile-picture-setting">
					<div class="mentee-image">
						<img id="blah" src="{{asset('design/images/mentor5.jpg')}}" alt="your image" title="">
					</div>
					<div class="upload-image">
						<input type="file" id="file-upload" name="image">
						<div class="file-style">
							<span><img src="{{asset('design/images/photo.png')}}"></span>
							Upload image
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row align-items-center">
						<label class="col-md-4">First name</label>
						<div class="col-md-8">
				  			<input type="text" class="input-style" id="email" placeholder="Enter your email address">
				  		</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row align-items-center">
						<label class="col-md-4">Last name</label>
						<div class="col-md-8">
				  			<input type="text" class="input-style" id="email" placeholder="Enter your email address">
				  		</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row align-items-center">
						<label class="col-md-4">Phone number</label>
						<div class="col-md-8">
				  			<input type="text" class="input-style" id="email" placeholder="Enter your email address">
				  		</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row align-items-center">
						<label class="col-md-4">Timezone</label>
						<div class="col-md-8">
						  <select class="select-style" id="sel1">
							<option value="/api/private/tutortimezone/383/">Africa/Abidjan GMT +0:00</option>
							<option value="/api/private/tutortimezone/384/">Africa/Accra GMT +0:00</option>
							<option value="/api/private/tutortimezone/385/">Africa/Addis_Ababa GMT +3:00</option>
							<option value="/api/private/tutortimezone/386/">Africa/Algiers GMT +1:00</option>
							<option value="/api/private/tutortimezone/387/">Africa/Asmara GMT +3:00</option>
							<option value="/api/private/tutortimezone/509/">Africa/Asmera GMT +3:00</option>
							<option value="/api/private/tutortimezone/388/">Africa/Bamako GMT +0:00</option>
							<option value="/api/private/tutortimezone/389/">Africa/Bangui GMT +1:00</option>
							<option value="/api/private/tutortimezone/390/">Africa/Banjul GMT +0:00</option>
							<option value="/api/private/tutortimezone/391/">Africa/Bissau GMT +0:00</option>
							<option value="/api/private/tutortimezone/392/">Africa/Blantyre GMT +2:00</option>
							<option value="/api/private/tutortimezone/393/">Africa/Brazzaville GMT +1:00</option>
							<option value="/api/private/tutortimezone/394/">Africa/Bujumbura GMT +2:00</option>
							<option value="/api/private/tutortimezone/382/">Africa/Cairo GMT +2:00</option>
							<option value="/api/private/tutortimezone/395/">Africa/Casablanca GMT +1:00</option>
							<option value="/api/private/tutortimezone/396/">Africa/Ceuta GMT +1:00</option>
							<option value="/api/private/tutortimezone/397/">Africa/Conakry GMT +0:00</option>
							<option value="/api/private/tutortimezone/398/">Africa/Dakar GMT +0:00</option>
							<option value="/api/private/tutortimezone/399/">Africa/Dar_es_Salaam GMT +3:00</option>
							<option value="/api/private/tutortimezone/400/">Africa/Djibouti GMT +3:00</option>
							<option value="/api/private/tutortimezone/401/">Africa/Douala GMT +1:00</option>
							<option value="/api/private/tutortimezone/402/">Africa/El_Aaiun GMT +1:00</option>
							<option value="/api/private/tutortimezone/403/">Africa/Freetown GMT +0:00</option>
							<option value="/api/private/tutortimezone/404/">Africa/Gaborone GMT +2:00</option>
							<option value="/api/private/tutortimezone/405/">Africa/Harare GMT +2:00</option>
							<option value="/api/private/tutortimezone/406/">Africa/Johannesburg GMT +2:00</option>
							<option value="/api/private/tutortimezone/407/">Africa/Juba GMT +2:00</option>
							<option value="/api/private/tutortimezone/408/">Africa/Kampala GMT +3:00</option>
							<option value="/api/private/tutortimezone/409/">Africa/Khartoum GMT +2:00</option>
							<option value="/api/private/tutortimezone/410/">Africa/Kigali GMT +2:00</option>
							<option value="/api/private/tutortimezone/411/">Africa/Kinshasa GMT +1:00</option>
							<option value="/api/private/tutortimezone/412/">Africa/Lagos GMT +1:00</option>
							<option value="/api/private/tutortimezone/413/">Africa/Libreville GMT +1:00</option>
							<option value="/api/private/tutortimezone/414/">Africa/Lome GMT +0:00</option>
							<option value="/api/private/tutortimezone/415/">Africa/Luanda GMT +1:00</option>
							<option value="/api/private/tutortimezone/416/">Africa/Lubumbashi GMT +2:00</option>
							<option value="/api/private/tutortimezone/417/">Africa/Lusaka GMT +2:00</option>
							<option value="/api/private/tutortimezone/418/">Africa/Malabo GMT +1:00</option>
							<option value="/api/private/tutortimezone/419/">Africa/Maputo GMT +2:00</option>
							<option value="/api/private/tutortimezone/420/">Africa/Maseru GMT +2:00</option>
							<option value="/api/private/tutortimezone/421/">Africa/Mbabane GMT +2:00</option>
							<option value="/api/private/tutortimezone/422/">Africa/Mogadishu GMT +3:00</option>
							<option value="/api/private/tutortimezone/423/">Africa/Monrovia GMT +0:00</option>
							<option value="/api/private/tutortimezone/424/">Africa/Nairobi GMT +3:00</option>
							<option value="/api/private/tutortimezone/425/">Africa/Ndjamena GMT +1:00</option>
							<option value="/api/private/tutortimezone/426/">Africa/Niamey GMT +1:00</option>
							<option value="/api/private/tutortimezone/427/">Africa/Nouakchott GMT +0:00</option>
							<option value="/api/private/tutortimezone/428/">Africa/Ouagadougou GMT +0:00</option>
							<option value="/api/private/tutortimezone/429/">Africa/Porto-Novo GMT +1:00</option>
							<option value="/api/private/tutortimezone/430/">Africa/Sao_Tome GMT +0:00</option>
							<option value="/api/private/tutortimezone/510/">Africa/Timbuktu GMT +0:00</option>
							<option value="/api/private/tutortimezone/431/">Africa/Tripoli GMT +2:00</option>
							<option value="/api/private/tutortimezone/432/">Africa/Tunis GMT +1:00</option>
							<option value="/api/private/tutortimezone/433/">Africa/Windhoek GMT +2:00</option>
							<option value="/api/private/tutortimezone/34/">America/Adak GMT -10:00</option>
							<option value="/api/private/tutortimezone/35/">America/Anchorage GMT -9:00</option>
							<option value="/api/private/tutortimezone/36/">America/Anguilla GMT -4:00</option>
							<option value="/api/private/tutortimezone/37/">America/Antigua GMT -4:00</option>
							<option value="/api/private/tutortimezone/38/">America/Araguaina GMT -3:00</option>
							<option value="/api/private/tutortimezone/39/">America/Argentina/Buenos_Aires GMT -3:00</option>
							<option value="/api/private/tutortimezone/40/">America/Argentina/Catamarca GMT -3:00</option>
							<option value="/api/private/tutortimezone/41/">America/Argentina/ComodRivadavia GMT -3:00</option>
							<option value="/api/private/tutortimezone/42/">America/Argentina/Cordoba GMT -3:00</option>
							<option value="/api/private/tutortimezone/43/">America/Argentina/Jujuy GMT -3:00</option>
							<option value="/api/private/tutortimezone/44/">America/Argentina/La_Rioja GMT -3:00</option>
							<option value="/api/private/tutortimezone/45/">America/Argentina/Mendoza GMT -3:00</option>
							<option value="/api/private/tutortimezone/46/">America/Argentina/Rio_Gallegos GMT -3:00</option>
							<option value="/api/private/tutortimezone/47/">America/Argentina/Salta GMT -3:00</option>
							<option value="/api/private/tutortimezone/48/">America/Argentina/San_Juan GMT -3:00</option>
							<option value="/api/private/tutortimezone/49/">America/Argentina/San_Luis GMT -3:00</option>
							<option value="/api/private/tutortimezone/50/">America/Argentina/Tucuman GMT -3:00</option>
							<option value="/api/private/tutortimezone/51/">America/Argentina/Ushuaia GMT -3:00</option>
							<option value="/api/private/tutortimezone/52/">America/Aruba GMT -4:00</option>
						  </select>
				  		</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row align-items-center">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="form-group">
				  				<input type="submit" class="rounded-button-style" id="" value="Save settings">
				  			</div>
				  		</div>
				  		<div class="col-md-4">
				  			<div class="form-group">
				  				<input type="button" class="rounded-button-style" id="" value="Detete account">
				  			</div>
				  		</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<section class="footer-top" style="background: url('./design/images/footer-top.jpg') no-repeat center center; background-size: cover; ">
	<div class="container">
		<h4>Every year n people prepare to interview confidently on mentorly. Get fast results with professional mentors. Prepare to achieve your goals today. </h4>

		<a href="#" class="prinery-btm blue-btm">Get Started</a>
	</div>
</section>

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection