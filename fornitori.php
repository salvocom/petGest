<?

function __autoload($class_name) {
	if (file_exists($class_name. '.php'))
		include $class_name . '.php';
	if (file_exists('HTML/'.$class_name. '.php'))	
		include 'HTML/'.$class_name . '.php';
	if (file_exists('functions/'.$class_name. '.php'))	
		include 'functions/'.$class_name . '.php';
	if (file_exists('ajax/'.$class_name. '.php'))	
		include 'ajax/'.$class_name . '.php';
}

//########################Connessione al DB e creazione Pagina
$db = new DBFunctions();
$page = new HTMLFornitori();

//########################Creazione Bottoni Pagina
$pagebuttons = array(
				'nuovo'=>array('id'=>'nuovo_fornitore' , 'type'=>'button' , 'name'=>'Nuovo Fornitore' , 'action'=>'nuovo' , 'page'=>'fornitori.php' , 'GET_values'=>null),
				'insert'=>array('id'=>'inserisci_fornitore' , 'type'=>'submit' , 'name'=>'Inserisci Fornitore' , 'action'=>'insert' , 'page'=>'fornitori.php' , 'GET_values'=>null),
				'modify'=>array('id'=>'modifica_fornitore' , 'type'=>'submit' , 'name'=>'Modifica Fornitore' , 'action'=>'modify' , 'page'=>'fornitori.php' , 'GET_values'=>null),
				'delete'=>array('id'=>'elimina_fornitore' , 'type'=>'submit' , 'name'=>'Elimina Fornitore' , 'action'=>'delete' , 'page'=>'fornitori.php' , 'GET_values'=>null),
				'preventivi'=>array('id'=>'preventivi_fornitore' , 'type'=>'button' , 'name'=>'Preventivi Fornitore' , 'action'=>'archivio' , 'page'=>'preventivi.php' , 'GET_values'=>array('id_fornitore'=>'')),
				'fatture'=>array('id'=>'fatture_fornitore' , 'type'=>'button' , 'name'=>'Fatture Fornitore' , 'action'=>'archivio' , 'page'=>'fatture.php' , 'GET_values'=>array('id_fornitore'=>'')),
				'archivio'=>array('id'=>'archivio_fornitori' , 'type'=>'button' , 'name'=>'Archivio Fornitori' , 'action'=>'archivio' , 'page'=>'fornitori.php' , 'GET_values'=>null),
				'annulla'=>array('id'=>'annulla_operazione' , 'type'=>'button' , 'name'=>'Annulla Operazione' , 'action'=>'annulla' , 'page'=>'fornitori.php' , 'GET_values'=>null),
				'torna'=>array('id'=>'torna_a_fornitore' , 'type'=>'button' , 'name'=>'Torna al Fornitore' , 'action'=>'torna' , 'page'=>'fornitori.php' , 'GET_values'=>array('id'=>'')),				
				'fornitori'=>array('id'=>'torna_a_fornitori' , 'type'=>'button' , 'name'=>'Torna alla pagina Fornitori' , 'action'=>'' , 'page'=>'fornitori.php' , 'GET_values'=>null)
				);

//########################Creazione Menu Pagina e Container
$page->drawPage('fornitori');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

//########################Se c'è stato un SUBMIT (Inserimento, Cancellazione o Modifica dati sul DB)
if (!empty($_POST))
{	
	//########################Se è stata effettuata una Ricerca
	if(isset($_POST['cerca']))
	{
		$customs = array('ID','azienda','nome','cognome','mail','telefono_1','telefono_2','fax');
		$result = $db->getCustomRows('fornitori',$_POST['cerca'],'cognome',$customs);
		
		//Se sono stati trovati risultati
		if (mysql_affected_rows() > 0)
		{
			$page->drawList('fornitori.php','container',$result,$db->getColumns('fornitori'),$customs);
		}
		//########################La ricerca non ha dato risultati
		else
		{
			$page->drawPar('container','La ricerca non ha dato nessun risultato');
			$buttons = array($pagebuttons['fornitori'],$pagebuttons['archivio']);
			$page->drawTableButtons('container',$buttons,'none');
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
			if ($key == 'regione')
				$fields[$key] = $db->getRegione($value);
			if ($key == 'provincia')
				$fields[$key] = $db->getProvincia($value);
			if ($key == 'comune')
				$fields[$key] = $db->getComune($value);
		}
		
		if($db->insertRows('fornitori',$fields))
			$page->drawPar('container','L\'inserimento è avvenuto con successo!');
		else
			$page->drawPar('container','Inserimento non riuscito : ' . mysql_error());
		$buttons = array($pagebuttons['fornitori'],$pagebuttons['archivio']);
		$page->drawTableButtons('container',$buttons,'none');
	}
	
	//########################Modifica Dati nel DB
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'modify')
	{
		$fields = null;
		foreach($_POST as $key=>$value)
		{
			if ($key != 'actionDB')
				$fields[$key] = $value;
			if ($key == 'regione')
				if($db->getRegione($value) != null)
					$fields[$key] = $db->getRegione($value);
			if ($key == 'provincia')
				if($db->getProvincia($value) != null)
					$fields[$key] = $db->getProvincia($value);
			if ($key == 'comune')
				if($db->getComune($value) != null)
					$fields[$key] = $db->getComune($value);
		}
		
		if($db->updateRows('fornitori',$fields))
			$page->drawPar('container','La modifica è avvenuta con successo!');
		else
			$page->drawPar('container','Modifica non riuscita : ' . mysql_error());
		$buttons = array($pagebuttons['fornitori'],$pagebuttons['torna'],$pagebuttons['archivio']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_POST['ID'];
		$page->drawTableButtons('container',$buttons,'none');
	}
	
	//########################Cancellazione Dati dal DB
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'delete')
	{
		$fields = null;
		foreach($_POST as $key=>$value)
		{
			if ($key != 'actionDB')
				$fields[$key] = $value;
		}
		
		if($db->deleteRow('fornitori',$fields))
			$page->drawPar('container','La cancellazione è avvenuta con successo!');
		else
			$page->drawPar('container','Cancellazione non riuscita : ' . mysql_error());
		$buttons = array($pagebuttons['fornitori'],$pagebuttons['archivio']);
		$page->drawTableButtons('container',$buttons,'none');
	}
}

//########################Pagina Iniziale
else if (empty($_GET))
{
	$buttons = array($pagebuttons['nuovo'],$pagebuttons['archivio']);
	$page->drawSearch('container','fornitori.php','Digita il Cognome del fornitore e premi Invio');
	$page->drawTableButtons('container',$buttons,'none');
}

//########################Se è stato cliccato un bottone
else
{
	//########################Form di Inserimento
	if (isset($_GET['action']) && $_GET['action'] == 'nuovo')
	{
		$buttons = array($pagebuttons['insert'],$pagebuttons['annulla']);
		$result = $db->getColumns('fornitori');
		$page->drawFornitoriForm('container',$result);
		$page->drawSelectOption('regione',$db->getRegioni(),false);
		$page->drawTableButtons('container',$buttons,'left');
	}
	
	//########################Annulla Operazione
	else if (isset($_GET['action']) && $_GET['action'] == 'annulla')
	{
		$buttons = array($pagebuttons['nuovo'],$pagebuttons['archivio']);
		$page->drawSearch('container','fornitori.php','Digita il Cognome del fornitore e premi Invio');
		$page->drawTableButtons('container', $buttons,'none');
	}
	
	//########################Archivio fornitori
	else if (isset($_GET['action']) && $_GET['action'] == 'archivio')
	{
		$customs = array('ID','azienda','nome','cognome','mail','telefono_1','telefono_2','fax');
		if (isset($_GET['key']))
			$result = $db->getCustomRows('fornitori',$_GET['key'],'cognome',$customs);
		else
			$result = $db->getCustomRows('fornitori','A','cognome',$customs);
		
		$buttons = array($pagebuttons['nuovo'],$pagebuttons['annulla']);	
		$page->drawButtonsArchive('fornitori.php','container');
		$page->drawList('fornitori.php','container',$result,$db->getColumns('fornitori'),$customs);
		$page->drawTableButtons('container',$buttons,'left');
	}
	
	//########################Torna alla Pagina Principale
	else if(isset($_GET['id']) or (isset($_GET['action']) && $_GET['action'] == 'torna'))
	{
		$buttons = array($pagebuttons['modify'],$pagebuttons['delete'],$pagebuttons['preventivi'],
							$pagebuttons['fatture'],$pagebuttons['annulla']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_GET['id'];
				if(array_key_exists('id_fornitore',$value['GET_values']))
					$buttons[$key]['GET_values']['id_fornitore']=$_GET['id'];
			}

		$columns = $db->getColumns('fornitori');
		$result = $db->getfornitore($_GET['id']);
		$page->drawFornitoriForm('container',$columns,$result);
		$page->drawSelectOption('regione',$db->getRegioni(),true,$result['regione']);
		$page->drawTableButtons('container',$buttons,'left');
	}
}

//########################Disegna la Pagina e Chiudi la connessione al DB
$page->draw();
$db->close_DB();
?>
