<?

function __autoload($class_name) {
	if (file_exists($class_name. '.php'))
		include $class_name . '.php';
	if (file_exists('HTML/'.$class_name. '.php'))	
		include 'HTML/'.$class_name. '.php';
	if (file_exists('functions/'.$class_name. '.php'))	
		include 'functions/'.$class_name . '.php';
}


$db = new DBFunctions();
$page = new HTMLPreventivi();

$pagebuttons = array(
				'nuovo'=>array('id'=>'nuovo_preventivo' , 'type'=>'button' , 'name'=>'Nuovo preventivo' , 'action'=>'nuovo' , 'page'=>'preventivi.php' , 'GET_values'=>array('id_cliente'=>'')),
				'insert'=>array('id'=>'inserisci_preventivo' , 'type'=>'submit' , 'name'=>'Inserisci preventivo' , 'action'=>'insert' , 'page'=>'preventivi.php' , 'GET_values'=>null),
				'modify'=>array('id'=>'modifica_preventivo' , 'type'=>'submit' , 'name'=>'Modifica preventivo' , 'action'=>'modify' , 'page'=>'preventivi.php' , 'GET_values'=>null),
				'delete'=>array('id'=>'elimina_preventivo' , 'type'=>'submit' , 'name'=>'Elimina preventivo' , 'action'=>'delete' , 'page'=>'preventivi.php' , 'GET_values'=>null),
				'archivio'=>array('id'=>'archivio_preventivi' , 'type'=>'button' , 'name'=>'Archivio Preventivi' , 'action'=>'archivio' , 'page'=>'preventivi.php' , 'GET_values'=>null),
				'torna'=>array('id'=>'torna_a_preventivo' , 'type'=>'button' , 'name'=>'Torna al preventivo' , 'action'=>'torna' , 'page'=>'preventivi.php' , 'GET_values'=>array('id'=>'')),		
				'stampa'=>array('id'=>'stampa_preventivo' , 'type'=>'button' , 'name'=>'Stampa Preventivo' , 'action'=>'stampa' , 'page'=>'preventivi.php' , 'GET_values'=>array('id'=>'','id_cliente'=>'')),
				'preventivi'=>array('id'=>'torna_a_preventivi' , 'type'=>'button' , 'name'=>'Torna alla pagina preventivi' , 'action'=>'' , 'page'=>'preventivi.php' , 'GET_values'=>null),
				'torna_cliente'=>array('id'=>'torna_a_cliente' , 'type'=>'button' , 'name'=>'Torna al Cliente' , 'action'=>'torna' , 'page'=>'clienti.php' , 'GET_values'=>array('id'=>'')),
				'torna_lista'=>array('id'=>'torna_a_lista' , 'type'=>'button' , 'name'=>'Torna a Lista Preventivi' , 'action'=>'archivio' , 'page'=>'preventivi.php' , 'GET_values'=>array('id_cliente'=>''))
				);

$page->drawPage('Preventivi');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

//Se c'è stato un SUBMIT (Inserimento, Cancellazione o Modifica dati sul DB)
if (!empty($_POST))
{
	if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'insert')
	{
		$data = explode('/',$_POST['data']);
		$_POST['data'] = "$data[2]-$data[1]-$data[0]";
		
		$preventivo = array(
						'id_cliente'=>$_POST['id_cliente'],
						'id_ambulatorio'=>$_POST['id_ambulatorio'],
						'totale_preventivo'=>$_POST['totale_preventivo'],
						'data'=>$_POST['data']
						);
		
		if($db->insertRows('preventivi',$preventivo))
		{
			$id_preventivo = $db->getLastID('preventivi');
			for($i = 1; $i < 10; $i++)
			{
				$prestazioni[$i] = array(
							'tipo'=>2,
							'id_riferimento'=>$id_preventivo,
							'descrizione'=>$_POST['descrizione'.$i],
							'quantita'=>$_POST['quantita'.$i],
							'costo'=>$_POST['costo'.$i],
							);
				$db->insertRows('istanze_prestazioni',$prestazioni[$i]);
			}
				
			$page->drawPar('container','L\'inserimento è avvenuto con successo!');
		}
		else
			$page->drawPar('container','Inserimento non riuscito : ' . mysql_error());
		
		$buttons = array($pagebuttons['torna_lista']);
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
		$data = explode('/',$_POST['data']);
		$_POST['data'] = "$data[2]-$data[1]-$data[0]";
		
		$preventivo = array(
						'ID'=>$_POST['ID'],
						'id_cliente'=>$_POST['id_cliente'],
						'id_ambulatorio'=>$_POST['id_ambulatorio'],
						'totale_preventivo'=>$_POST['totale_preventivo'],
						'data'=>$_POST['data']
						);
		
		if($db->updateRows('preventivi',$preventivo))
		{
			for($i = 1; $i < 10; $i++)
			{
				if(array_key_exists('ID'.$i,$_POST))
				{
					$prestazioni[$i] = array(
								'ID'=>$_POST['ID'.$i],
								'tipo'=>2,
								'id_riferimento'=>$_POST['ID'],
								'descrizione'=>$_POST['descrizione'.$i],
								'quantita'=>$_POST['quantita'.$i],
								'costo'=>$_POST['costo'.$i],
								);
					$db->updateRows('istanze_prestazioni',$prestazioni[$i]);
				}
				else
				{
					$prestazioni[$i] = array(
							'tipo'=>2,
							'id_riferimento'=>$_POST['ID'],
							'descrizione'=>$_POST['descrizione'.$i],
							'quantita'=>$_POST['quantita'.$i],
							'costo'=>$_POST['costo'.$i],
							);
					$db->insertRows('istanze_prestazioni',$prestazioni[$i]);
				}
			}
			$page->drawPar('container','La modifica è avvenuta con successo!');
		}
		else
			$page->drawPar('container','Modifica non riuscita : ' . mysql_error());
		
		$buttons = array($pagebuttons['torna'],$pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_POST['ID'];
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$_POST['id_cliente'];
			}
		$page->drawTableButtons('container',$buttons,'none');
	}
	//Cancellazione
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'delete')
	{		
		if($db->deleteRows('preventivi',$_POST['ID']))
		{
			for($i = 1; $i < 10; $i++)
			{
				if(array_key_exists('ID'.$i,$_POST))
				{
					$db->deleteRows('istanze_prestazioni',$_POST['ID'.$i]);
				}
			}
			$page->drawPar('container','La cancellazione è avvenuta con successo!');
		}
		else
			$page->drawPar('container','Cancellazione non riuscita : ' . mysql_error());
		$buttons = array($pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$_POST['id_cliente'];
			}
		$page->drawTableButtons('container',$buttons,'none');
	}
}

//Pagina preventivi Standard
else if (empty($_GET))
{
	$buttons = array($pagebuttons['nuovo'],$pagebuttons['archivio']);
	$page->drawTableButtons('container',$buttons,'none');
}

//Se è stato cliccato un bottone
else
{
	//Form per inserimento nuovo preventivo
	if (isset($_GET['action']) && $_GET['action'] == 'nuovo' && isset($_GET['id_cliente']))
	{
		$ambulatorio = $db->getAmbulatorio('1');
		$clienti = $db->getCliente($_GET['id_cliente']);
		
		$page->drawHeaderAmbulatorio('container',$ambulatorio,' - '.$clienti['nome'].' '.$clienti['cognome']);
		$page->drawHeaderCliente('tablediv',$clienti);

		$buttons = array($pagebuttons['insert'],$pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$_GET['id_cliente'];
			}
		$page->drawTableButtons('tablediv',$buttons,'right');
		
		$prestazioni = $db->getAssocColumns('istanze_prestazioni');
		$page->drawPrestazioniPreventivi('tablediv',$prestazioni);

		$preventivi = $db->getAssocColumns('preventivi');
		$page->drawPreventiviForm('tablediv',$preventivi);		
	}
	
	else if (isset($_GET['action']) && $_GET['action'] == 'archivio' and isset($_GET['id_cliente']))
	{
		$customs = array('ID','totale_preventivo','data');
		$result = $db->getCustomRows('preventivi',$_GET['id_cliente'],'id_cliente',$customs);
		
		$buttons = array($pagebuttons['nuovo'],$pagebuttons['torna_cliente']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_GET['id_cliente'];
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$_GET['id_cliente'];
			}
		
		$cliente = $db->getCliente($_GET['id_cliente']);
		$page->drawList('preventivi.php','container',$result,$db->getColumns('preventivi'),$customs,null,' - '.$cliente['nome'].' '.$cliente['cognome']);
		$page->drawTableButtons('container',$buttons,'left');
	}
	
	else if (isset($_GET['action']) && isset($_GET['id']) && isset($_GET['id_cliente']) && $_GET['action'] == 'stampa')
	{	
		$cliente = $db->getCliente($_GET['id_cliente']);		
		$preventivo = $db->getPreventivo($_GET['id']);
		$ambulatorio = $db->getAmbulatorio('1');
		$prestazioni = $db->getPrestazioni($_GET['id'],2);
		
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->pageHeader($ambulatorio);
		$pdf->Preventivo($preventivo);
		$pdf->Cliente($cliente);
		$header = array('Descrizione', 'Quantita\'', 'Costo');
		$pdf->PrestazioniPreventivo($header,$prestazioni,$preventivo);
		
		$pdf->Output();
	}
	
	else if(isset($_GET['id']) or (isset($_GET['action']) && $_GET['action'] == 'torna'))
	{
		$buttons = array($pagebuttons['stampa'],$pagebuttons['modify'],$pagebuttons['delete'],$pagebuttons['torna_lista']);

		$preventivo = $db->getPreventivo($_GET['id']);

		$ambulatorio = $db->getAmbulatorio('1');
		$clienti = $db->getCliente($preventivo['id_cliente']);
		
		$page->drawHeaderAmbulatorio('container',$ambulatorio,' - '.$clienti['nome'].' '.$clienti['cognome']);
		$page->drawHeaderCliente('tablediv',$clienti);

		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_GET['id'];
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$preventivo['id_cliente'];
			}
		$page->drawTableButtons('tablediv',$buttons,'right');
		
		$prestazioni = $db->getAssocColumns('istanze_prestazioni');
		$prestazione = $db->getPrestazioni($_GET['id'],2);
		$page->drawPrestazioniPreventivi('tablediv',$prestazioni,$prestazione,$preventivo['data']);
		
		$preventivi = $db->getAssocColumns('preventivi');
		$page->drawPreventiviForm('tablediv',$preventivi,$preventivo);
	}
}

$page->draw();
$db->close_DB();
?>
