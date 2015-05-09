<?

function __autoload($class_name) {
	if (file_exists($class_name. '.php'))
		include $class_name . '.php';
	if (file_exists('HTML/'.$class_name. '.php'))	
		include 'HTML/'.$class_name . '.php';
	if (file_exists('functions/'.$class_name. '.php'))	
		include 'functions/'.$class_name . '.php';
}

$db = new DBFunctions();
$page = new HTML();
$mail = new Mail();

$page->drawPage('Home');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

$page->drawPar('container','Benvenuta Dott.ssa Patania!');

$inviomail = $db->getOperazioni(date("Y-m-d"));
if(count($inviomail) == 0)
{
	$ritorno = true;
	$avvisi = $db->getAvvisi(date("Y-m-d"));

	if($avvisi != null)
	{
		foreach($avvisi as $avviso)
		{
			$paziente = $db->getPaziente($avviso['id_paziente']);
			$cliente = $db->getCliente($paziente['id_cliente']);
			$data = explode('-',$avviso['data_scadenza']);
			$scadenza = "$data[2]/$data[1]/$data[0]";
			if(file_exists("logs/logs_mail_".date("Ymd").".log"))
			{
				$logs = file("logs/logs_mail_".date("Ymd").".log");
				if(!in_array("Messaggio inviato all'indirizzo al cliente ".$cliente['nome']." ".$cliente['cognome']." con indirizzo ".$cliente['mail']."\n", $logs))
				{
					$esito = $mail->inviamail($cliente['mail'],'Richiamo Vaccino '.$avviso['tipo'],'Gentile Cliente, questa per avvisarla che giorno '.$scadenza.' è necessario il richiamo del vaccino '.$avviso['tipo'].' per '.$paziente['nome'].'. La invitiamo pertanto a presentarsi in Ambulatorio o a fissare un appuntamento. Cordiali Saluti.', date("Ymd"), $cliente['nome']." ".$cliente['cognome']);
					if(!$esito)
						$ritorno = false;
				}
			}
			else
			{
				$esito = $mail->inviamail($cliente['mail'],'Richiamo Vaccino '.$avviso['tipo'],'Gentile Cliente, questa per avvisarla che giorno '.$scadenza.' è necessario il richiamo del vaccino '.$avviso['tipo'].' per '.$paziente['nome'].'. La invitiamo pertanto a presentarsi in Ambulatorio o a fissare un appuntamento. Cordiali Saluti.', date("Ymd"), $cliente['nome']." ".$cliente['cognome']);
				if(!$esito)
					$ritorno = false;
			}
		}
		
		if($ritorno)
		{
			$db->insertRows('operazioni',array('tipo'=>'inviomail','data'=>date("Y-m-d")));
			$page->drawPar('container','Le E-Mails di Avviso per i richiami dei vaccini sono state inviate con successo!');
		}
		else
			$page->drawPar('container','Errore nell\'invio delle E-Mails di Avviso per i richiami dei vaccini!');
	}
	else
	{
		$db->insertRows('operazioni',array('tipo'=>'inviomail','data'=>date("Y-m-d")));
		$page->drawPar('container','Nessuna E-Mail di Avviso per i richiami dei vaccini da inviare!');
	}
	
	
}

$pagebuttons = array(
				'cliente'=>array('id'=>'nuovo_cliente' , 'type'=>'button' , 'name'=>'Nuovo Cliente' , 'action'=>'nuovo' , 'page'=>'clienti.php' , 'GET_values'=>null),
				'pazienti'=>array('id'=>'archivio_paziente' , 'type'=>'button' , 'name'=>'Archivio Pazienti' , 'action'=>'archivio' , 'page'=>'pazienti.php' , 'GET_values'=>null),
				'visite'=>array('id'=>'visualizza_visite' , 'type'=>'button' , 'name'=>'Visualizza Visite' , 'action'=>'visualizza' , 'page'=>'visite.php' , 'GET_values'=>null),
				);

$page->drawTableButtons('container', $pagebuttons,'none');

$page->draw();
$db->close_DB();
?>
