<?
//include('phpmailer/phpmailer.inc.php');
//include('phpmailer/smtp.inc.php');
include('PHPmailer/class.phpmailer.php');

class Mail
{
	function __construct() 
	{}
	
	function inviamail($to, $subject, $body, $date, $cliente) 
	{
		$logs = fopen("logs/logs_mail_$date.log","a");
		
		$from = "ambulatorioveterinarioibleo@gmail.com";
		$from_name = "Ambulatorio Veterinaio Ibleo - Dott.ssa Tatiana Patania";
		$mail = new PHPMailer();  // creiamo l'oggetto
		$mail->IsSMTP(); // abilitiamo l'SMTP
		$mail->SMTPDebug = 2;  // debug: 1 = solo messaggi, 2 = errori e messaggi
		$mail->SMTPAuth = true;  // abilitiamo l'autenticazione
		$mail->SMTPSecure = 'ssl'; // abilitiamo il protocollo ssl richiesto per Gmail
		$mail->Host = 'smtp.gmail.com'; // ecco il server smtp di google
		$mail->Port = 465; // la porta che dobbiamo utilizzare
		$mail->Username = 'ambulatorioveterinarioibleo@gmail.com'; //email del nostro account gmail
		$mail->Password = 'tatyambulatorio'; //password del nostro account gmail
		$mail->SetFrom($from, $from_name);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AddAddress($to);
		if(!$mail->Send()) {
			fwrite($logs, "errore nell\'invio della mail al cliente $cliente con indirizzo $to: $mail->ErrorInfo\n");
			fclose($logs);
			return false;
		} else {
			fwrite($logs, "Messaggio inviato all'indirizzo al cliente $cliente con indirizzo $to\n");
			fclose($logs);
			return true;
		}
	}
	
	function inviamailLibero($to, $subject, $body) 
	{
		$from = "ambulatoriovetibleo@libero.it";
		$from_name = "Ambulatorio Veterinaio Ibleo - Dott.ssa Tatiana Patania";
		$mail = new PHPMailer();  // creiamo l'oggetto
		$mail->IsSMTP(); // abilitiamo l'SMTP
		$mail->SMTPDebug = 2;  // debug: 1 = solo messaggi, 2 = errori e messaggi
		$mail->SMTPAuth = true;  // abilitiamo l'autenticazione
		$mail->SMTPSecure = 'ssl'; // abilitiamo il protocollo ssl richiesto per Gmail
		$mail->Host = 'smtp.libero.it'; // ecco il server smtp di google
		$mail->Port = 465; // la porta che dobbiamo utilizzare
		$mail->Username = 'ambulatoriovetibleo@libero.it'; //email del nostro account gmail
		$mail->Password = 'leonessa78'; //password del nostro account gmail
		$mail->SetFrom($from, $from_name);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AddAddress($to);
		if(!$mail->Send()) {
			fwrite($logs, "errore nell\'invio della mail al cliente $cliente con indirizzo $to: $mail->ErrorInfo\n");
			fclose($logs);
			return false;
		} else {
			fwrite($logs, "Messaggio inviato all'indirizzo al cliente $cliente con indirizzo $to\n");
			fclose($logs);
			return true;
		}
	}
	
	function checkMail($email)
{
	// elimino spazi, "a capo" e altro alle estremità della stringa
	$email = trim($email);

	// se la stringa è vuota sicuramente non è una mail
	if(!$email) {
		return false;
	}

	// controllo che ci sia una sola @ nella stringa
	$num_at = count(explode( '@', $email )) - 1;
	if($num_at != 1) {
		return false;
	}

	// controllo la presenza di ulteriori caratteri "pericolosi":
	if(strpos($email,';') || strpos($email,',') || strpos($email,' ')) {
		return false;
	}

	// la stringa rispetta il formato classico di una mail?
	if(!preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $email)) {
		return false;
	}

	return true;
}
}

?>
