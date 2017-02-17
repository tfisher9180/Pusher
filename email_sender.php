<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

    	<title>Pusher</title>

    	<link rel="stylesheet" href="./libs/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="./libs/font-awesome/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
		<link rel="stylesheet" href="./css/main.css">

	</head>

	<body>

	<?php

		require './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		if ($_POST) {

			$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
			$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
			$full_name = $first_name . ' ' . $last_name;
			$email = isset($_POST['email']) ? $_POST['email'] : '';
			$message = isset($_POST['message']) ? $_POST['message'] : '';
			$booking = isset($_POST['reason']) ? $_POST['reason'] : false;

			if ($first_name != '' && $last_name != '' && $email != '' && $message != '') {
				$from = 'From: Pusher Offical';
				$to = 'timothy.fisher@riosalado.edu';
				$subject = $booking ? 'Booking Inquiry: '.$full_name : 'General Inquiry: '.$full_name;

				$body = "From: $full_name\n E-mail: $email\n Message:\n $message";

				if (mail($to, $subject, $body, $from)) {
					$feedback = '<h2 class="section-title">MESSAGE SENT<i class="equalizer"></i></h2>
							<h4>THANKS! I\'LL GET BACK TO YOU ASAP</h4>';
				} else {
					$feedback = '<h2 class="section-title">ERROR<i class="equalizer"></i></h2>
							<h4>SOMETHING WENT WRONG, PLEASE TRY AGAIN</h4>';
				}
			} else {
				$feeback = '<h2 class="section-title">ERROR<i class="equalizer"></i></h2>
							<h4>SOME FIELDS ARE MISSING, PLEASE CHECK THE DATA AND TRY AGAIN</h4>';
			}

		} else {
			$feedback = '<h2 class="section-title">ERROR<i class="equalizer"></i></h2>
							<h4>NO FORM DATA, PLEASE FILL OUT THE CONTACT FORM</h4>';
		}

	?>

		<header id="header">
			<div class="valign-wrapper">
				<div class="valign">
					<div class="col-md-6 col-md-offset-3">
						<div class="header-text text-center">
							<?php echo $feedback; ?>
							<a id="goBack" href="#" class="btn btn-primary">GO BACK</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		
		<script>
			$('#goBack').click(function(e) {
				e.preventDefault();
				window.history.back();
			});
		</script>

		<script src="./libs/jquery/dist/jquery.min.js"></script>
		<script src="./libs/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="./js/iOS-Orientationchange-Fix.js"></script>
		<script src="./js/main.js"></script>

	</body>
</html>