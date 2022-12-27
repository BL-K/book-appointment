<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Medical Register</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="{{ asset ('patient/css/bootstrap.min.css')}}">		
		<link rel="stylesheet" href="{{ asset ('patient/plugins/fontawesome/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{ asset ('patient/plugins/fontawesome/css/all.min.css')}}">
		<link rel="stylesheet" href="{{ asset ('patient/css/style.css')}}">
</head>
<body>
		<div class="main-wrapper">
		
			@include('includes.patient_menu')
			
			@yield('content')

            @include('includes.patient_footer')
        </div>

		<script src="{{ asset ('patient/js/popper.min.js')}}"></script>
		<script src="{{ asset ('patient/js/jquery.min.js')}}"></script>
		<script src="{{ asset ('patient/js/bootstrap.min.js')}}"></script>
		<script src="{{ asset ('patient/js/slick.js')}}"></script>
		<script src="{{ asset ('patient/js/script.js')}}"></script>

		<script type="text/javascript">
			$(document).ready(function()
			{
				load_review();

				function load_review()
				{
					var doctor_id = $('.doctor_id').val();
					var _token = $('input[name = "_token"]').val();
					$.ajax({
						url: "{{url('/load-review')}}",
						method: "POST",
						data: {doctor_id:doctor_id, _token:_token},
						success: function (data) {
							$('#review_show').html(data);
						}
					});
				}

				$('.send-review').click(function () { 
					var doctor_id = $('.doctor_id').val();
					var review_name = $('.review_name').val();
					var review_content = $('.review_content').val();
					var _token = $('input[name = "_token"]').val();
					$.ajax({
						url: "{{url('/send-review')}}",
						method: "POST",
						data: {doctor_id:doctor_id, review_name:review_name, review_content:review_content, _token:_token},
						success: function (data) {
							$('#notify_review').html('<p class="alert alert-success">Đánh giá đã được gửi thành công.</p>')
							load_review();
							$('#notify_review').fadeOut(5000);
							$('.review_name').val('');
							$('.review_content').val('');
						}
					});
				});
			});
		</script>
</body>
	@include('patient.hospital_modal')
</html>