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

$page->drawPage('Pazienti');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

//Se c'è stato un SUBMIT (Inserimento, Cancellazione o Modifica dati sul DB)
if (!empty($_POST))
{
	//Se è stata effettuata una ricerca per cognome cliente
	if(isset($_POST['cerca']))
	{
		$customs = array('ID','nome','id_microchip','specie','razza','sesso','data_di_nascita');
		$result = $db->getCustomRows('ricette',$_POST['cerca'],'nome',$customs);
		
		//Se sono stati trovati risultati
		if (mysql_affected_rows() > 0)
		{
			$page->drawList('ricette.php','container',$result,$db->getColumns('ricette'),$customs);
		}
		//La ricerca non ha dato risultati
		else
		{
			$page->drawPar('container','La ricerca non ha dato nessun risultato');
			$buttons = array('Torna alla pagina Ricette'=>'ricette.php',
							'Archivio Ricette'=>'button');
			$page->drawTableButtons('container', $buttons,'ricette.php','none');
		}
	}
	//Inserimento
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'insert')
	{
		$fields = null;
		foreach($_POST as $key=>$value)
		{
			if ($key != 'actionDB')
				$fields[$key] = $value;
		}
		
		if($db->insertRows('ricette',$fields))
			$page->drawPar('container','L\'inserimento è avvenuto con successo!');
		else
			$page->drawPar('container','Inserimento non riuscito : ' . mysql_error());
		$buttons = array('Torna alla pagina Ricette'=>'ricette.php',
							'Archivio Ricette'=>'button');
		$page->drawTableButtons('container', $buttons,'ricette.php','none');
	}
	//Modifica
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'modify')
	{
		$fields = null;
		foreach($_POST as $key=>$value)
		{
			if ($key != 'actionDB')
				$fields[$key] = $value;
		}
		
		if($db->updateRows('ricette',$fields))
			$page->drawPar('container','La Modifica è avvenuta con successo!');
		else
			$page->drawPar('container','Modifica non riuscita : ' . mysql_error());
		$buttons = array('Torna alla pagina Ricette'=>'ricette.php',
							'Archivio Ricette'=>'button');
		$page->drawTableButtons('container', $buttons,'ricette.php','none');
	}
	//Cancellazione
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'delete')
	{
		$fields = null;
		foreach($_POST as $key=>$value)
		{
			if ($key != 'actionDB')
				$fields[$key] = $value;
		}
		
		if($db->deleteRow('ricette',$fields))
			$page->drawPar('container','La cancellazione è avvenuta con successo!');
		else
			$page->drawPar('container','Cancellazione non riuscita : ' . mysql_error());
		$buttons = array('Torna alla pagina Ricette'=>'ricette.php',
							'Archivio Ricette'=>'button');
		$page->drawTableButtons('container', $buttons,'ricette.php','none');
	}
}

//Pagina Clienti Standard
else if (empty($_GET))
{
	$buttons = array('Nuova Ricetta'=>'button',
						'Archivio Ricette'=>'button');
	$page->drawTableButtons('container', $buttons,'ricette.php','none');
}

//Se è stato cliccato un bottone
else
{
	//Form per inserimento nuovo cliente
	if (isset($_GET['action']) && $_GET['action'] == 'nuovo')
	{
		$buttons = array('Inserisci Ricetta'=>'submit',
					'Archivio Ricette'=>'button',
					'Annulla Operazione'=>'button');
		$result = $db->getColumns('ricette');
		$page->drawFormTable('container','ricette.php',$result);
		$page->drawTableButtons('container',$buttons,'ricette.php','left');
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'annulla')
	{
		$buttons = array('Nuovo Ricetta'=>'button',
							'Archivio Ricette'=>'button');
		$page->drawSearch('container','ricette.php','Digita il Nome del Paziente e premi Invio');
		$page->drawTableButtons('container', $buttons,'ricette.php','none');
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'archivio')
	{
		$customs = array('ID','nome','id_microchip','specie','razza','sesso','data_di_nascita');
		if (isset($_GET['key']))
			$result = $db->getCustomRows('ricette',$_GET['key'],'nome',$customs);
		else
			$result = $db->getCustomRows('ricette','A','nome',$customs);

		$page->drawButtonsArchive('ricette.php','container');
		$page->drawList('ricette.php','container',$result,$db->getColumns('ricette'),$customs);
	}
	else if(isset($_GET['id']) or (isset($_GET['action']) && $_GET['action'] == 'torna'))
	{
		$buttons = array('Modifica Ricetta'=>'submit',
					'Elimina Ricetta'=>'submit',
					'Archivio Ricette'=>'button',
					'Annulla Operazione'=>'button');
		$columns = $db->getColumns('ricette');
		$result = $db->getRows('ricette',$_GET['id'],'ID');
		$page->drawFormTable('container','ricette.php',$columns,$result);
		$page->drawTableButtons('container',$buttons,'ricette.php','left');
	}
}

$page->draw();
$db->close_DB();
?>
