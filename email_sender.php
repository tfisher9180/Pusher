<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

    	<title>Pusher</title>

    	<link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="./vendor/fortawesome/font-awesome/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
		<link rel="stylesheet" href="./css/main.css">

	</head>

	<body>

	<?php

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

				$body = "From: $full_name\nE-mail: $email\nMessage:\n\n$message";

				date_default_timezone_set('Etc/UTC');

				require './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;

				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->Debugoutput = 'html';
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 587;
				$mail->SMTPSecure = 'tls';
				$mail->SMTPAuth = true;
				$mail->Username = 'tfisher9180@gmail.com';
				$mail->Password = 'Ilovekayleesimpson2';
				$mail->setFrom('tfisher9180@gmail.com', 'Timothy Fisher');
				$mail->addAddress($to, 'Pusher Official');
				$mail->Subject = $subject;
				$mail->Body = $body;

				if (!$mail->send()) {
					$feedback = '<h2 class="section-title">ERROR<i class="equalizer"></i></h2>
							<h4>SOMETHING WENT WRONG, PLEASE TRY AGAIN</h4>';
				} else {
					$feedback = '<h2 class="section-title">MESSAGE SENT<i class="equalizer"></i></h2>
							<h4>THANKS! I\'LL GET BACK TO YOU ASAP</h4>';
				}
			} else {
				$feedback = '<h2 class="section-title">ERROR<i class="equalizer"></i></h2>
							<h4>SOME FIELDS ARE MISSING, PLEASE CHECK THE DATA AND TRY AGAIN</h4>';
			}

		} else {
			$feedback = '<h2 class="section-title">ERROR<i class="equalizer"></i></h2>
							<h4>NO FORM DATA, PLEASE FILL OUT THE CONTACT FORM</h4>';
		}

	?>

		<header id="feedback-header" style="background-color: #212121;">
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

		<script src="./vendor/components/jquery/jquery.min.js"></script>
		<script src="./vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="./js/iOS-Orientationchange-Fix.js"></script>

		<script>
			$('#goBack').click(function(e) {
				e.preventDefault();
				window.history.back();
			});
		</script>

	</body>
</html>