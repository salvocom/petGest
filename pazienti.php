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
$page = new HTMLPazienti();

$specie = array('2'=>'Aviaria','1'=>'Canina','3'=>'Equina','4'=>'Felina','5'=>'Leporide');
$sesso = array('Maschio','Maschio Castrato','Femmina','Femmina Sterilizzata');
$taglie = array('Mini','Piccola','Media','Grande','Gigante');
$pelo = array('Corto','Medio','Lungo');

$pagebuttons = array(
				'nuovo'=>array('id'=>'nuovo' , 'type'=>'button' , 'name'=>'Nuovo paziente' , 'action'=>'nuovo' , 'page'=>'pazienti.php' , 'GET_values'=>array('id_cliente'=>'')),
				'insert'=>array('id'=>'inserisci_paziente' , 'type'=>'submit' , 'name'=>'Inserisci paziente' , 'action'=>'insert' , 'page'=>'pazienti.php' , 'GET_values'=>null),
				'modify'=>array('id'=>'modifica_paziente' , 'type'=>'submit' , 'name'=>'Modifica paziente' , 'action'=>'modify' , 'page'=>'pazienti.php' , 'GET_values'=>null),
				'delete'=>array('id'=>'elimina_paziente' , 'type'=>'submit' , 'name'=>'Elimina paziente' , 'action'=>'delete' , 'page'=>'pazienti.php' , 'GET_values'=>null),
				'pazienti'=>array('id'=>'torna_a_pazienti' , 'type'=>'button' , 'name'=>'Torna alla pagina Pazienti' , 'action'=>'' , 'page'=>'pazienti.php' , 'GET_values'=>null),
				'ricette'=>array('id'=>'ricette_paziente' , 'type'=>'button' , 'name'=>'Ricette paziente' , 'action'=>'ricette' , 'page'=>'ricette.php' , 'GET_values'=>array('id_paziente'=>'')),
				'certificati'=>array('id'=>'certificati_paziente' , 'type'=>'button' , 'name'=>'Certificati paziente' , 'action'=>'certificati' , 'page'=>'certificati.php' , 'GET_values'=>array('id_paziente'=>'')),
				'vaccini'=>array('id'=>'vaccini_paziente' , 'type'=>'button' , 'name'=>'Vaccini paziente' , 'action'=>'archivio' , 'page'=>'vaccini.php' , 'GET_values'=>array('id_paziente'=>'','id_cliente'=>'')),
				'esami'=>array('id'=>'esami_paziente' , 'type'=>'button' , 'name'=>'Esami paziente' , 'action'=>'archivio' , 'page'=>'esami.php' , 'GET_values'=>array('id_paziente'=>'')),
				'archivio'=>array('id'=>'archivio_pazienti' , 'type'=>'button' , 'name'=>'Archivio pazienti' , 'action'=>'archivio' , 'page'=>'pazienti.php' , 'GET_values'=>null),
				'torna'=>array('id'=>'torna_a_paziente' , 'type'=>'button' , 'name'=>'Torna al paziente' , 'action'=>'torna' , 'page'=>'pazienti.php' , 'GET_values'=>array('id'=>'')),
				'torna_cliente'=>array('id'=>'torna_a_cliente' , 'type'=>'button' , 'name'=>'Torna al Cliente' , 'action'=>'torna' , 'page'=>'clienti.php' , 'GET_values'=>array('id'=>'')),
				'torna_lista'=>array('id'=>'torna_a_lista' , 'type'=>'button' , 'name'=>'Torna a Lista Pazienti' , 'action'=>'archivio' , 'page'=>'pazienti.php' , 'GET_values'=>array('id_cliente'=>'')),
				);

$page->drawPage('Pazienti');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

//Se c'è stato un SUBMIT (Inserimento, Cancellazione o Modifica dati sul DB)
if (!empty($_POST))
{
	//########################Se è stata effettuata una Ricerca
	if(isset($_POST['cerca']))
	{
		$customs = array('ID','nome','microchip','specie','razza','sesso','data_di_nascita');
		
		if(is_numeric($_POST['cerca']))
			$result = $db->getCustomPazienti('pazienti',$_POST['cerca'],'microchip',$customs);
		else
			$result = $db->getCustomRows('pazienti',$_POST['cerca'],'nome',$customs);			
		
		//Se sono stati trovati risultati
		if (mysql_affected_rows() > 0)
		{
			$page->drawList('pazienti.php','container',$result,$db->getColumns('pazienti'),$customs);
			$buttons = array($pagebuttons['pazienti']);
			$page->drawTableButtons('container',$buttons,'left');
		}
		//########################La ricerca non ha dato risultati
		else
		{
			$page->drawPar('container','La ricerca non ha dato nessun risultato');
			$buttons = array($pagebuttons['pazienti']);
			$page->drawTableButtons('container',$buttons,'center');
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
			if ($key == 'specie')
				$fields[$key] = $specie[$value];
			if ($key == 'data_di_registrazione')
			{
				$data = explode('/',$_POST[$key]);
				$fields[$key] = "$data[2]-$data[1]-$data[0]";
			}
			if ($key == 'data_di_nascita' and $_POST[$key]!=null)
			{
				$data = explode('/',$_POST[$key]);
				$fields[$key] = "$data[2]-$data[1]-$data[0]";
			}
			if ($key == 'data_decesso' and $_POST[$key]!=null)
			{
				$data = explode('/',$_POST[$key]);
				$fields[$key] = "$data[2]-$data[1]-$data[0]";
			}
		}
		
		if($db->insertRows('pazienti',$fields))
			$page->drawPar('container','L\'inserimento è avvenuto con successo!');
		else
			$page->drawPar('container','Inserimento non riuscito : ' . mysql_error());
		
		$buttons = array($pagebuttons['torna_lista'],$pagebuttons['archivio']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{	
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$_POST['id_cliente'];
			}
		$page->drawTableButtons('container',$buttons,'none');
	}
	//Modifica
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'modify')
	{
		$fields = null;
		foreach($_POST as $key=>$value)
		{
			if ($key != 'actionDB')
				$fields[$key] = $value;
			if ($key == 'specie')
				$fields[$key] = $specie[$value];
			if ($key == 'data_di_registrazione')
			{
				$data = explode('/',$_POST[$key]);
				$fields[$key] = "$data[2]-$data[1]-$data[0]";
			}
			if ($key == 'data_di_nascita' and $_POST[$key]!=null)
			{
				$data = explode('/',$_POST[$key]);
				$fields[$key] = "$data[2]-$data[1]-$data[0]";
			}
			if ($key == 'data_decesso' and $_POST[$key]!=null)
			{
				$data = explode('/',$_POST[$key]);
				$fields[$key] = "$data[2]-$data[1]-$data[0]";
			}
		}
		
		if($db->updateRows('pazienti',$fields))
			$page->drawPar('container','La Modifica è avvenuta con successo!');
		else
			$page->drawPar('container','Modifica non riuscita : ' . mysql_error());
		
		$buttons = array($pagebuttons['torna'],$pagebuttons['archivio']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{	
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_POST['ID'];
			}
		$page->drawTableButtons('container',$buttons,'none');
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
		
		if($db->deleteRow('pazienti',$fields))
			$page->drawPar('container','La cancellazione è avvenuta con successo!');
		else
			$page->drawPar('container','Cancellazione non riuscita : ' . mysql_error());
		$buttons = array($pagebuttons['archivio']);
			$page->drawTableButtons('container',$buttons,'none');
	}
}

//########################Pagina Iniziale
else if (empty($_GET))
{
	$page->drawSearch('container','pazienti.php','Digita il Nome o il Microchip del Paziente e premi Invio');
}

//Se è stato cliccato un bottone
else
{
	//Form per inserimento nuovo paziente
	if (isset($_GET['action']) && $_GET['action'] == 'nuovo' && isset($_GET['id_cliente']))
	{
		$buttons = array($pagebuttons['insert'],$pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$_GET['id_cliente'];
			}
			
		$result = $db->getColumns('pazienti');
		$page->drawPazientiForm('container',$result,null,$_GET['id_cliente']);
		$page->drawPazientiOption('specie',$specie,false);
		$page->drawPazientiOption('sesso',$sesso,false);
		$page->drawPazientiOption('taglia',$taglie,false);
		$page->drawPazientiOption('pelo',$pelo,false);
		$page->drawTableButtons('container',$buttons,'left');
	}
	
	else if (isset($_GET['action']) && $_GET['action'] == 'archivio' && isset($_GET['id_cliente']))
	{
		$buttons = array($pagebuttons['torna_cliente'],$pagebuttons['nuovo']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_GET['id_cliente'];
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$_GET['id_cliente'];
			}

		$customs = array('ID','Nome','Microchip','Specie','Razza','Sesso','Data di Nascita');
		$result = $db->getPazienti($_GET['id_cliente']);
		$cliente = $db->getCliente($_GET['id_cliente']);
		$page->drawListPazienti('pazienti.php','container',$result,$customs,null,' - '.$cliente['nome'].' '.$cliente['cognome']);
		$page->drawTableButtons('container',$buttons,'left');
	}
	
	else if(isset($_GET['id']) or (isset($_GET['action']) && $_GET['action'] == 'torna'))
	{
		$buttons = array($pagebuttons['modify'],$pagebuttons['delete'],$pagebuttons['esami'],$pagebuttons['ricette'],$pagebuttons['certificati'],
							$pagebuttons['vaccini'],$pagebuttons['torna_lista']);
		
		$columns = $db->getColumns('pazienti');
		$result = $db->getPaziente($_GET['id']);
		$page->drawPazientiForm('container',$columns,$result);
		$page->drawPazientiOption('specie',$specie,true,$result['specie']);
		$page->drawPazientiOption('sesso',$sesso,true,$result['sesso']);
		$page->drawPazientiOption('taglia',$taglie,true,$result['taglia']);
		$page->drawPazientiOption('pelo',$pelo,true,$result['pelo']);
		
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_GET['id'];
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_GET['id'];
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$result['id_cliente'];
			}
		$page->drawTableButtons('container',$buttons,'left');
	}
}

$page->draw();
$db->close_DB();
?>
