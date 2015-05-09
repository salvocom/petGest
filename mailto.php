<?

function __autoload($class_name) {
	if (file_exists($class_name. '.php'))
		include $class_name . '.php';
	if (file_exists('HTML/'.$class_name. '.php'))	
		include 'HTML/'.$class_name . '.php';
	if (file_exists('functions/'.$class_name. '.php'))	
		include 'functions/'.$class_name . '.php';
}

//########################Connessione al DB e creazione Pagina
$db = new DBFunctions();
$page = new HTMLMail();
$mail = new Mail();

//########################Creazione Bottoni Pagina
$pagebuttons = array(
				'nuovo'=>array('id'=>'nuova_mail' , 'type'=>'button' , 'name'=>'Nuova Mail' , 'action'=>'nuovo' , 'page'=>'mailto.php' , 'GET_values'=>null),
				'insert'=>array('id'=>'invia_mail' , 'type'=>'submit' , 'name'=>'Invia Mail' , 'action'=>'insert' , 'page'=>'mailto.php' , 'GET_values'=>null),
				'archivio'=>array('id'=>'archivio_mail' , 'type'=>'button' , 'name'=>'Archivio Mail' , 'action'=>'archivio' , 'page'=>'mailto.php' , 'GET_values'=>null),
				'mail'=>array('id'=>'torna_a_mail' , 'type'=>'button' , 'name'=>'Torna alla pagina Mail' , 'action'=>'' , 'page'=>'mailto.php' , 'GET_values'=>null)
				);

//########################Creazione Menu Pagina e Container
$page->drawPage('Mailto');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

//########################Se c'è stato un SUBMIT (Inserimento, Cancellazione o Modifica dati sul DB)
if (!empty($_POST))
{	
	//########################Se è stata effettuata una Ricerca
	if(isset($_POST['cerca']))
	{
		$customs = array('ID','oggetto','data_di_modifica');
		$result = $db->getCustomRows('mail',$_POST['cerca'],'ID',$customs);
		
		//Se sono stati trovati risultati
		if (mysql_affected_rows() > 0)
		{
			$page->drawList('mailto.php','container',$result,$db->getColumns('mail'),$customs);
			$buttons = array($pagebuttons['nuovo'],$pagebuttons['mail']);
			$page->drawTableButtons('container',$buttons,'left');
		}
		//########################La ricerca non ha dato risultati
		else
		{
			$page->drawPar('container','La ricerca non ha dato nessun risultato');
			$buttons = array($pagebuttons['nuovo'],$pagebuttons['clienti']);
			$page->drawTableButtons('container',$buttons,'center');
		}
	}
	
	//########################Inserimento Dati nel DB
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'insert')
	{
		$fields = null;
		foreach($_POST as $key=>$value)
		{
			if ($key != 'actionDB')
				$fields[$key] = $value;
		}
		
		$ritorno = true;
		$clienti = $db->getClientiMail();
		//$clienti =  array("0" => array("mail"=>"salvocom@gmail.com", "nome"=>"salvo", "cognome"=>"salvo"),
		//				"1" => array("mail"=>"salvatore.malpasso@gmail.com", "nome"=>"salvo", "cognome"=>"salvo"));

		if($clienti != null)
		{
			$oggetto = $fields["oggetto"];
			$testo = $fields["testo"];
			foreach($clienti as $cliente)
			{
				if(file_exists("logs/logs_mail_".date("Ymd").".log"))
				{
					$logs = file("logs/logs_mail_".date("Ymd").".log");
					$esito = $mail->inviamail($cliente['mail'],$oggetto,$testo, date("Ymd"), $cliente['nome']." ".$cliente['cognome']);
					if(!$esito)
						$ritorno = false;
				}
				else
				{
					$esito = $mail->inviamail($cliente['mail'],$oggetto,$testo, date("Ymd"), $cliente['nome']." ".$cliente['cognome']);
					if(!$esito)
						$ritorno = false;
				}
			}
		}
		else
			$page->drawPar('container','Nessun indirizzo E-Mail trovato!');
		
		if($db->insertRows('mail',$fields))
			$page->drawPar('container','L\'invio è avvenuto con successo!');
		else
			$page->drawPar('container','Invio non riuscito : ' . mysql_error());
		$buttons = array($pagebuttons['mail'],$pagebuttons['archivio']);
		$page->drawTableButtons('container',$buttons,'none');
	}
	
}

//########################Pagina Iniziale
else if (empty($_GET))
{
	$buttons = array($pagebuttons['nuovo'],$pagebuttons['archivio']);
	$page->drawTableButtons('container',$buttons,'none');
}

//########################Se è stato cliccato un bottone
else
{
	//########################Form di Inserimento
	if (isset($_GET['action']) && $_GET['action'] == 'nuovo')
	{
		$buttons = array($pagebuttons['insert'],$pagebuttons['mail']);
		$result = $db->getColumns('mail');
		$page->drawMailForm('container',$result);
		$page->drawTableButtons('container',$buttons,'left');
	}
	
	//########################Archivio Mail
	else if (isset($_GET['action']) && $_GET['action'] == 'archivio')
	{
		$customs = array('ID','oggetto','data_di_modifica');
		$result = $db->getCustomRows('mail',"",'ID',$customs);
		
		$buttons = array($pagebuttons['nuovo'],$pagebuttons['mail']);
		$page->drawList('mailto.php','container',$result,$db->getColumns('mail'),$customs);
		$page->drawTableButtons('container',$buttons,'left');
	}
	
	//########################Torna alla Pagina Principale
	else if(isset($_GET['id']) or (isset($_GET['action']) && $_GET['action'] == 'torna'))
	{
		$buttons = array($pagebuttons['mail'], $pagebuttons['archivio']);

		$columns = $db->getColumns('mail');
		$result = $db->getMail($_GET['id']);
		$page->drawMailForm('container',$columns,$result);
		$page->drawTableButtons('container',$buttons,'left');
	}
}

//########################Disegna la Pagina e Chiudi la connessione al DB
$page->draw();
$db->close_DB();
?>
