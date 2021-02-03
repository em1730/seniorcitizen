<?php

$base_url = "http://34.92.117.58/sccdrrmo/";  //change this baseurl value as per your file path
			$mail_body = "
			<p>Hi ".$username.",</p>
			<p>Thanks for Registration.</p>
			<p>Please Open this link to verified your email address - ".$base_url."email_verification.php?activation_code=".$verification."
			<p>Best Regards,<br />SCCDRRMO</p>
			";
			require 'class/class.phpmailer.php';
			$mail = new PHPMailer;
			$mail->IsSMTP();								//Sets Mailer to send message using SMTP
			$mail->Host = 'smtp.gmail.com';		        //Sets the SMTP hosts of your Email hosting, this for Godaddy
			$mail->Port = '465';								//Sets the default SMTP server port
			$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
			$mail->Username = 'sccdrrmo.mobile@gmail.com';		//Sets SMTP username
			$mail->Password = 'itcsomobile';					//Sets SMTP password
			$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
			$mail->From = 'sccdrrmo.mobile@gmail.com';			//Sets the From email address for the message
			$mail->FromName = 'San Carlos DRRMO';					//Sets the From name of the message
			$mail->AddAddress($_POST['email'], $_POST['username']);		//Adds a "To" address			
			$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
			$mail->IsHTML(true);							//Sets message type to HTML				
			$mail->Subject = 'Email Verification';			//Sets the Subject of the message
			$mail->Body = $mail_body;							//An HTML or plain text message body
			if($mail->Send())								//Send an Email. Return true on success or false on error
			{
				// $message = '<label class="text-success">Register Done, Please check your mail.</label>';
				$alert_msg .= ' 
				<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fa fa-check"></i>Registered Successfully. Please check your e-mail for verification.
				</div>     
			';
            }
            
 ?>