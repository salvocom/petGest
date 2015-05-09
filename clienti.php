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
$page = new HTMLClienti();

//########################Creazione Bottoni Pagina
$pagebuttons = array(
				'nuovo'=>array('id'=>'nuovo_cliente' , 'type'=>'button' , 'name'=>'Nuovo Cliente' , 'action'=>'nuovo' , 'page'=>'clienti.php' , 'GET_values'=>null),
				'insert'=>array('id'=>'inserisci_cliente' , 'type'=>'submit' , 'name'=>'Inserisci Cliente' , 'action'=>'insert' , 'page'=>'clienti.php' , 'GET_values'=>null),
				'modify'=>array('id'=>'modifica_cliente' , 'type'=>'submit' , 'name'=>'Modifica Cliente' , 'action'=>'modify' , 'page'=>'clienti.php' , 'GET_values'=>null),
				'delete'=>array('id'=>'elimina_cliente' , 'type'=>'submit' , 'name'=>'Elimina Cliente' , 'action'=>'delete' , 'page'=>'clienti.php' , 'GET_values'=>null),
				'pazienti'=>array('id'=>'pazienti_cliente' , 'type'=>'button' , 'name'=>'Pazienti Cliente' , 'action'=>'archivio' , 'page'=>'pazienti.php' , 'GET_values'=>array('id_cliente'=>'')),
				'preventivi'=>array('id'=>'preventivi_cliente' , 'type'=>'button' , 'name'=>'Preventivi Cliente' , 'action'=>'archivio' , 'page'=>'preventivi.php' , 'GET_values'=>array('id_cliente'=>'')),
				'fatture'=>array('id'=>'fatture_cliente' , 'type'=>'button' , 'name'=>'Fatture Cliente' , 'action'=>'archivio' , 'page'=>'fatture.php' , 'GET_values'=>array('id_cliente'=>'')),
				'archivio'=>array('id'=>'archivio_clienti' , 'type'=>'button' , 'name'=>'Archivio Clienti' , 'action'=>'archivio' , 'page'=>'clienti.php' , 'GET_values'=>null),
				'torna'=>array('id'=>'torna_a_cliente' , 'type'=>'button' , 'name'=>'Torna al Cliente' , 'action'=>'torna' , 'page'=>'clienti.php' , 'GET_values'=>array('id'=>'')),				
				'clienti'=>array('id'=>'torna_a_clienti' , 'type'=>'button' , 'name'=>'Torna alla pagina Clienti' , 'action'=>'' , 'page'=>'clienti.php' , 'GET_values'=>null)
				);

//########################Creazione Menu Pagina e Container
$page->drawPage('Clienti');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

//########################Se c'è stato un SUBMIT (Inserimento, Cancellazione o Modifica dati sul DB)
if (!empty($_POST))
{	
	//########################Se è stata effettuata una Ricerca
	if(isset($_POST['cerca']))
	{
		$customs = array('ID','nome','cognome','mail','telefono_1','telefono_2','telefono_3');
		$result = $db->getCustomRows('clienti',$_POST['cerca'],'cognome',$customs);
		
		//Se sono stati trovati risultati
		if (mysql_affected_rows() > 0)
		{
			$page->drawList('clienti.php','container',$result,$db->getColumns('clienti'),$customs);
			$buttons = array($pagebuttons['nuovo'],$pagebuttons['clienti']);
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
			if ($key == 'regione')
				$fields[$key] = $db->getRegione($value);
			if ($key == 'provincia')
				$fields[$key] = $db->getProvincia($value);
			if ($key == 'comune')
				$fields[$key] = $db->getComune($value);
			if ($key == 'provincia_di_nascita')
				if($db->getProvincia($value) != null)
					$fields[$key] = $db->getProvincia($value);
			if ($key == 'comune_di_nascita')
				if($db->getComune($value) != null)
					$fields[$key] = $db->getComune($value);
			if ($key == 'data_di_nascita' and $_POST[$key]!=null)
			{
				$data = explode('/',$_POST[$key]);
				$fields[$key] = "$data[2]-$data[1]-$data[0]";
			}
			if ($key == 'data_di_registrazione')
			{
				$data_reg = explode('/',$_POST[$key]);
				$fields[$key] = "$data_reg[2]-$data_reg[1]-$data_reg[0]";
			}
		}
		
		if($db->insertRows('clienti',$fields))
			$page->drawPar('container','L\'inserimento è avvenuto con successo!');
		else
			$page->drawPar('container','Inserimento non riuscito : ' . mysql_error());
		$buttons = array($pagebuttons['clienti'],$pagebuttons['archivio']);
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
			if ($key == 'data_di_nascita' and $_POST[$key]!=null)
			{
				$data = explode('/',$_POST[$key]);
				$fields[$key] = "$data[2]-$data[1]-$data[0]";
			}
			if ($key == 'data_di_registrazione')
			{
				$data = explode('/',$_POST[$key]);
				$fields[$key] = "$data[2]-$data[1]-$data[0]";
			}
		}
		
		if($db->updateRows('clienti',$fields))
			$page->drawPar('container','La modifica è avvenuta con successo!');
		else
			$page->drawPar('container','Modifica non riuscita : ' . mysql_error());
		$buttons = array($pagebuttons['clienti'],$pagebuttons['torna'],$pagebuttons['archivio']);
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
		
		if($db->deleteRows('clienti',$fields['ID']))
		{
			$fatture = $db->getFatture($fields['ID']);
			if(!is_null($fatture))
			{
				foreach($fatture as $fattura)
				{
					$db->deleteRows('fatture',$fattura['ID']);
					$prestazioni = $db->getPrestazioni($fattura['ID']);
					foreach($prestazioni as $prestazione)
						$db->deleteRows('istanze_prestazioni',$prestazione['ID']);
				}
			}
			
			$preventivi = $db->getPreventivi($fields['ID']);
			if(!is_null($preventivi))
			{
				foreach($preventivi as $preventivo)
				{
					$db->deleteRows('preventivi',$preventivo['ID']);
					$prestazioni = $db->getPrestazioni($preventivi['ID']);
					foreach($prestazioni as $prestazione)
						$db->deleteRows('istanze_prestazioni',$prestazione['ID']);
				}
			}
			
			$pazienti = $db->getPazienti($fields['ID']);
			if(!is_null($pazienti))
			{
				foreach($pazienti as $paziente)
					$db->deleteRows('pazienti',$paziente['ID']);
			}
			
			$page->drawPar('container','La cancellazione è avvenuta con successo!');
		}
		else
			$page->drawPar('container','Cancellazione non riuscita : ' . mysql_error());
		$buttons = array($pagebuttons['clienti'],$pagebuttons['archivio']);
		$page->drawTableButtons('container',$buttons,'none');
	}
}

//########################Pagina Iniziale
else if (empty($_GET))
{
	$buttons = array($pagebuttons['nuovo'],$pagebuttons['archivio']);
	$page->drawSearch('container','clienti.php','Digita il Cognome del Cliente e premi Invio');
	$page->drawTableButtons('container',$buttons,'none');
}

//########################Se è stato cliccato un bottone
else
{
	//########################Form di Inserimento
	if (isset($_GET['action']) && $_GET['action'] == 'nuovo')
	{
		$buttons = array($pagebuttons['insert'],$pagebuttons['clienti']);
		$result = $db->getColumns('clienti');
		$page->drawClientiForm('container',$result);
		$page->drawSelectOption('regione',$db->getRegioni(),false);
		$page->drawTableButtons('container',$buttons,'left');
	}
	
	//########################Archivio Clienti
	else if (isset($_GET['action']) && $_GET['action'] == 'archivio')
	{
		$customs = array('ID','nome','cognome','mail','telefono_1','telefono_2','telefono_3');
		if (isset($_GET['key']))
			$result = $db->getCustomRows('clienti',$_GET['key'],'cognome',$customs);
		else
			$result = $db->getCustomRows('clienti','A','cognome',$customs);
		
		$buttons = array($pagebuttons['nuovo'],$pagebuttons['clienti']);
		$page->drawButtonsArchive('clienti.php','container');
		$page->drawList('clienti.php','container',$result,$db->getColumns('clienti'),$customs);
		$page->drawTableButtons('container',$buttons,'left');
	}
	
	//########################Torna alla Pagina Principale
	else if(isset($_GET['id']) or (isset($_GET['action']) && $_GET['action'] == 'torna'))
	{
		$buttons = array($pagebuttons['modify'],$pagebuttons['delete'],$pagebuttons['pazienti'],
							$pagebuttons['preventivi'],$pagebuttons['fatture'],$pagebuttons['clienti']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_GET['id'];
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$_GET['id'];
			}

		$columns = $db->getColumns('clienti');
		$result = $db->getCliente($_GET['id']);
		$page->drawClientiForm('container',$columns,$result);
		$page->drawSelectOption('regione',$db->getRegioni(),true,$result['regione']);
		$page->drawTableButtons('container',$buttons,'left');
	}
}

//########################Disegna la Pagina e Chiudi la connessione al DB
$page->draw();
$db->close_DB();
?>
