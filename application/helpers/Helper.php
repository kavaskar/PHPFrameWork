<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');

class Helper {
	
	public static function sendMail($to, $subject, $msg, $attachment=false){
		
		load_lib('phpmailer');
		$config = load_config('email');

		$mail = new PHPMailerLite(); // defaults to using php "Sendmail" (or Qmail, depending on availability)

		$mail->IsMail(); // telling the class to use native PHP mail()

		$mail->SetFrom($config['from'], $config['from_name']);
		
		$mail->AddAddress($to);

		$mail->Subject    = $subject;

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mail->MsgHTML($msg);
		
		if($attachment) $mail->AddAttachment($attachment);

		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		else {
			echo "Message sent!";
		}
		
	}
	
	
	
}








