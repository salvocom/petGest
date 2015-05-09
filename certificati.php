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

$page->drawPage('Certificati');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

//Se c'è stato un SUBMIT (Inserimento, Cancellazione o Modifica dati sul DB)
if (!empty($_POST))
{
	//Se è stata effettuata una ricerca per cognome cliente
	if(isset($_POST['cerca']))
	{
		//$customs = array('ID','nome','id_microchip','specie','razza','sesso','data_di_nascita');
		$result = $db->getCustomRows('certificati',$_POST['cerca'],'nome',$customs);
		
		//Se sono stati trovati risultati
		if (mysql_affected_rows() > 0)
		{
			$page->drawList('certificati.php','container',$result,$db->getColumns('certificati'),$customs);
		}
		//La ricerca non ha dato risultati
		else
		{
			$page->drawPar('container','La ricerca non ha dato nessun risultato');
			$buttons = array('Torna alla pagina Certificati'=>'certificati.php',
							'Archivio Certificati'=>'button');
			$page->drawTableButtons('container', $buttons,'certificati.php','none');
		}
	}
	//Inserimento
	else
	{
		if($db->insertRows('certificati',$_POST))
			$page->drawPar('container','L\'inserimento è avvenuto con successo!');
		else
			$page->drawPar('container','Inserimento non riuscito : ' . mysql_error());
		$buttons = array('Torna alla pagina Certificati'=>'certificati.php',
							'Archivio Certificati'=>'button');
		$page->drawTableButtons('container', $buttons,'certificati.php','none');
	}
}

//Pagina Clienti Standard
else if (empty($_GET))
{
	$buttons = array('Nuovo Certificato'=>'button',
						'Archivio Certificati'=>'button');
	$page->drawTableButtons('container', $buttons,'certificati.php','none');
}

//Se è stato cliccato un bottone
else
{
	//Form per inserimento nuovo cliente
	if (isset($_GET['name']) && $_GET['name'] == 'nuovo_paziente')
	{
		$buttons = array('Inserisci Certificato'=>'submit',
					'Archivio Certificati'=>'button',
					'Annulla Operazione'=>'button');
		$result = $db->getColumns('certificati');
		$page->drawFormTable('container','certificati.php',$result);
		$page->drawTableButtons('container',$buttons,'certificati.php','left');
	}
	else if (isset($_GET['name']) && $_GET['name'] == 'annulla_operazione')
	{
		$buttons = array('Nuovo Certificato'=>'button',
							'Archivio Certificati'=>'button');
		$page->drawTableButtons('container', $buttons,'certificati.php','none');
	}
	else if (isset($_GET['name']) && $_GET['name'] == 'archivio_certificati')
	{
		$customs = array('ID','nome','id_microchip','specie','razza','sesso','data_di_nascita');
		$result = $db->getCustomRows('certificati','a','nome',$customs);

		$page->drawList('certificati.php','container',$result,$db->getColumns('certificati'),$customs);
	}
	else if(isset($_GET['id']))
	{
		$buttons = array('Modifica Certificato'=>'submit',
					'Archivio Certificati'=>'button',
					'Annulla Operazione'=>'button');
		$columns = $db->getColumns('certificati');
		$result = $db->getRows('certificati',$_GET['id'],'ID');
		$page->drawFormTable('container','certificati.php',$columns,$result);
		$page->drawTableButtons('container',$buttons,'certificati.php','left');
	}
}

$page->draw();
$db->close_DB();
?>
