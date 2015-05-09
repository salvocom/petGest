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
$page = new HTMLFatture();

$pagebuttons = array(
				'nuovo'=>array('id'=>'nuova_fattura' , 'type'=>'button' , 'name'=>'Nuova fattura' , 'action'=>'nuovo' , 'page'=>'fatture.php' , 'GET_values'=>array('id_cliente'=>'')),
				'insert'=>array('id'=>'inserisci_fattura' , 'type'=>'submit' , 'name'=>'Inserisci fattura' , 'action'=>'insert' , 'page'=>'fatture.php' , 'GET_values'=>null),
				'modify'=>array('id'=>'modifica_fattura' , 'type'=>'submit' , 'name'=>'Modifica fattura' , 'action'=>'modify' , 'page'=>'fatture.php' , 'GET_values'=>null),
				'delete'=>array('id'=>'elimina_fattura' , 'type'=>'submit' , 'name'=>'Elimina fattura' , 'action'=>'delete' , 'page'=>'fatture.php' , 'GET_values'=>null),
				'annulla'=>array('id'=>'annulla_operazione' , 'type'=>'button' , 'name'=>'Annulla Operazione' , 'action'=>'annulla' , 'page'=>'fatture.php' , 'GET_values'=>null),
				'archivio'=>array('id'=>'archivio_fatture' , 'type'=>'button' , 'name'=>'Archivio fatture' , 'action'=>'archivio' , 'page'=>'fatture.php' , 'GET_values'=>null),
				'torna'=>array('id'=>'torna_a_fattura' , 'type'=>'button' , 'name'=>'Torna alla fattura' , 'action'=>'torna' , 'page'=>'fatture.php' , 'GET_values'=>array('id'=>'')),
				'stampa'=>array('id'=>'stampa_fattura' , 'type'=>'button' , 'name'=>'Stampa Fattura' , 'action'=>'stampa' , 'page'=>'fatture.php' , 'GET_values'=>array('id'=>'','id_cliente'=>'')),
				'fatture'=>array('id'=>'torna_a_fatture' , 'type'=>'button' , 'name'=>'Torna alla pagina fatture' , 'action'=>'' , 'page'=>'fatture.php' , 'GET_values'=>null),
				'torna_cliente'=>array('id'=>'torna_a_cliente' , 'type'=>'button' , 'name'=>'Torna al Cliente' , 'action'=>'torna' , 'page'=>'clienti.php' , 'GET_values'=>array('id'=>'')),
				'torna_lista'=>array('id'=>'torna_a_lista' , 'type'=>'button' , 'name'=>'Torna a Lista fatture' , 'action'=>'archivio' , 'page'=>'fatture.php' , 'GET_values'=>array('id_cliente'=>''))
				);

$page->drawPage('Fatture');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

//Se c'è stato un SUBMIT (Inserimento, Cancellazione o Modifica dati sul DB)
if (!empty($_POST))
{
	//########################Se è stata effettuata una Ricerca
	if(isset($_POST['cerca']))
	{
		$customs = array('ID','totale_imponibile','totale_IVA','totale_fattura','data','nome','cognome');
		$fatture =$db->getCustomRows('fatture',$_POST['cerca'],'ID',$customs);
		
		//Se sono stati trovati risultati
		if (mysql_affected_rows() > 0)
		{
			$page->drawList('fatture.php','container',$fatture,$db->getColumns('fatture'),$customs);
			$buttons = array($pagebuttons['archivio'],$pagebuttons['fatture']);
			$page->drawTableButtons('container',$buttons,'left');
		}
		//########################La ricerca non ha dato risultati
		else
		{
			$page->drawPar('container','La ricerca non ha dato nessun risultato');
			$buttons = array($pagebuttons['archivio'],$pagebuttons['fatture']);
			$page->drawTableButtons('container',$buttons,'center');
		}
	}
	
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'insert')
	{
		$data = explode('/',$_POST['data']);
		$_POST['data'] = "$data[2]-$data[1]-$data[0]";
		
		$numero_fattura = $db->getNumeroFattura($data[2]);
				
		$fattura = array(
						'id_cliente'=>$_POST['id_cliente'],
						'id_ambulatorio'=>$_POST['id_ambulatorio'],
						'id_paziente'=>$_POST['id_paziente'],
						'numero_fattura'=>$numero_fattura,
						'totale_prestazione'=>$_POST['totale_prestazione'],
						'totale_enpav'=>$_POST['totale_enpav'],
						'totale_imponibile'=>$_POST['totale_imponibile'],
						'totale_IVA'=>$_POST['totale_IVA'],
						'totale_imponibile-IVA'=>$_POST['totale_imponibile-IVA'],
						'ritenuta_di_acconto'=>$_POST['ritenuta_di_acconto'],
						'totale_fattura'=>$_POST['totale_fattura'],
						'data'=>$_POST['data'],
						'stato'=>$_POST['stato'],
						'indirizzo_manuale'=>1,
						'nome'=>$_POST['nome'],
						'cognome'=>$_POST['cognome'],
						'indirizzo'=>$_POST['indirizzo'],
						'cap'=>$_POST['cap'],
						'comune'=>$_POST['comune'],
						'provincia'=>$_POST['provincia'],
						'codice_fiscale'=>$_POST['codice_fiscale'],
						'partita_iva'=>$_POST['partita_iva']
						);
		
		if($db->insertRows('fatture',$fattura))
		{
			$id_fattura = $db->getLastID('fatture');
			for($i = 1; $i < 10; $i++)
			{
				if($_POST['descrizione'.$i] != null)
				{
					$prestazioni[$i] = array(
								'tipo'=>1,
								'id_riferimento'=>$id_fattura,
								'descrizione'=>$_POST['descrizione'.$i],
								'quantita'=>$_POST['quantita'.$i],
								'costo'=>$_POST['costo'.$i],
								'enpav'=>$_POST['enpav'.$i],
								'IVA'=>$_POST['IVA'.$i],
								'tipo_operazione'=>$_POST['tipo_operazione'.$i],
								'tipo_esenzione'=>$_POST['tipo_esenzione'.$i]
								);
					$db->insertRows('istanze_prestazioni',$prestazioni[$i]);
				}
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
		
		$fattura = array(
						'ID'=>$_POST['ID'],
						'id_cliente'=>$_POST['id_cliente'],
						'id_ambulatorio'=>$_POST['id_ambulatorio'],
						'id_paziente'=>$_POST['id_paziente'],
						'totale_prestazione'=>$_POST['totale_prestazione'],
						'totale_enpav'=>$_POST['totale_enpav'],
						'totale_imponibile'=>$_POST['totale_imponibile'],
						'totale_IVA'=>$_POST['totale_IVA'],
						'totale_imponibile-IVA'=>$_POST['totale_imponibile-IVA'],
						'ritenuta_di_acconto'=>$_POST['ritenuta_di_acconto'],
						'totale_fattura'=>$_POST['totale_fattura'],
						'data'=>$_POST['data'],
						'stato'=>$_POST['stato'],
						);
		
		if($db->updateRows('fatture',$fattura))
		{
			for($i = 1; $i < 10; $i++)
			{
				if(array_key_exists('ID'.$i,$_POST) && array_key_exists('costo'.$i,$_POST))
				{
					$prestazioni[$i] = array(
								'ID'=>$_POST['ID'.$i],
								'tipo'=>1,
								'id_riferimento'=>$_POST['ID'],
								'descrizione'=>$_POST['descrizione'.$i],
								'quantita'=>$_POST['quantita'.$i],
								'costo'=>$_POST['costo'.$i],
								'enpav'=>$_POST['enpav'.$i],
								'IVA'=>$_POST['IVA'.$i],
								'tipo_operazione'=>$_POST['tipo_operazione'.$i],
								'tipo_esenzione'=>$_POST['tipo_esenzione'.$i]
								);
					$db->updateRows('istanze_prestazioni',$prestazioni[$i]);
				}
				else if($_POST['descrizione'.$i] != null)
				{
					$prestazioni[$i] = array(
							'tipo'=>1,
							'id_riferimento'=>$_POST['ID'],
							'descrizione'=>$_POST['descrizione'.$i],
							'quantita'=>$_POST['quantita'.$i],
							'costo'=>$_POST['costo'.$i],
							'enpav'=>$_POST['enpav'.$i],
							'IVA'=>$_POST['IVA'.$i],
							'tipo_operazione'=>$_POST['tipo_operazione'.$i],
							'tipo_esenzione'=>$_POST['tipo_esenzione'.$i]
							);
					$db->insertRows('istanze_prestazioni',$prestazioni[$i]);
				}
				else if(array_key_exists('ID'.$i,$_POST))
				{
					$db->deleteRows('istanze_prestazioni',$_POST['ID'.$i]);
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
		if($db->deleteRows('fatture',$_POST['ID']))
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
	else if(isset($_POST['anno']) && isset($_POST['mese']))
	{
		if(!empty($_POST['mese']) && !empty($_POST['anno']))
		{
			$customs = array('ID','totale_imponibile','totale_IVA','totale_fattura','data','nome','cognome');		
			$buttons = array($pagebuttons['fatture']);
			
			$page->drawFattureFiltro('container',$_POST['anno'],$_POST['mese']);
			$fatture =$db->getFattureMese($_POST['anno'],$_POST['mese'],$customs);
			$page->drawFatturato('tablediv',$fatture);
			$fatture =$db->getFattureMese($_POST['anno'],$_POST['mese'],$customs);
			$page->drawFattureList('fatture.php','tablediv',$fatture,$db->getColumns('fatture'),$customs);
			$page->drawTableButtons('container',$buttons,'left');
		}
		else
		{
			$customs = array('ID','totale_imponibile','totale_IVA','totale_fattura','data','nome','cognome');
			$fatture =$db->getCustomRows('fatture','','ID',$customs);
			
			$buttons = array($pagebuttons['fatture']);
			
			$page->drawFattureFiltro('container',date('Y'));
			$page->drawFatturato('tablediv');
			$page->drawFattureList('fatture.php','tablediv',$fatture,$db->getColumns('fatture'),$customs);
			$page->drawTableButtons('container',$buttons,'left');
		}
	}
}

//Pagina fatture Standard
else if (empty($_GET))
{
	$buttons = array($pagebuttons['archivio']);
	$page->drawSearch('container','fatture.php','Digita il numero della fattura e premi Invio');
	$page->drawTableButtons('container',$buttons,'none');
}

//Se è stato cliccato un bottone
else
{
	//Form per inserimento nuovo preventivo
	if (isset($_GET['action']) && $_GET['action'] == 'nuovo' && isset($_GET['id_cliente']))
	{
		$buttons = array($pagebuttons['insert'],$pagebuttons['torna_lista']);
		
		$ambulatorio = $db->getAmbulatorio('1');
		$clienti = $db->getCliente($_GET['id_cliente']);
		
		$page->drawFattureAmbulatorio('container',$ambulatorio,' - '.$clienti['nome'].' '.$clienti['cognome']);
		$page->drawFattureCliente('tablediv',$clienti,false);
		
		$pazienti = $db->getPazienti($_GET['id_cliente']);
		$page->drawFatturePazienti('tablediv',$pazienti);
		
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$_GET['id_cliente'];
			}
		$page->drawTableButtons('tablediv',$buttons,'right');

		$prestazioni = $db->getAssocColumns('istanze_prestazioni');
		$page->drawPrestazioniFatture('tablediv',$prestazioni);
		
		$fatture = $db->getAssocColumns('fatture');
		$page->drawFattureForm('tablediv',$fatture);
		
	}
	
	else if (isset($_GET['action']) && isset($_GET['id_cliente']) && $_GET['action'] == 'archivio')
	{
		$customs = array('ID','id_cliente','id_ambulatorio','totale_fattura','data');
		$fatture =$db->getCustomRows('fatture',$_GET['id_cliente'],'id_cliente',$customs);
		
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
		$page->drawList('fatture.php','container',$fatture,$db->getColumns('fatture'),$customs,null,' - '.$cliente['nome'].' '.$cliente['cognome']);
		$page->drawTableButtons('container',$buttons,'left');
	}
	
	//########################Archivio fatture
	else if (isset($_GET['action']) && $_GET['action'] == 'archivio')
	{
		$customs = array('ID','totale_imponibile','totale_IVA','totale_fattura','data','nome','cognome');
		$fatture =$db->getCustomRows('fatture','','ID',$customs);
		
		$buttons = array($pagebuttons['fatture']);
		
		$page->drawFattureFiltro('container',date('Y'));
		$page->drawFatturato('tablediv');
		$page->drawFattureList('fatture.php','tablediv',$fatture,$db->getColumns('fatture'),$customs);
		$page->drawTableButtons('container',$buttons,'left');
	}
	
	else if (isset($_GET['action']) && isset($_GET['id']) && isset($_GET['id_cliente']) && $_GET['action'] == 'stampa')
	{	
				
		$fattura = $db->getFattura($_GET['id']);
		if($fattura['indirizzo_manuale'] == 0)
			$cliente = $db->getCliente($_GET['id_cliente']);
		else
			$cliente = array('nome'=>$fattura['nome'],
							'cognome'=>$fattura['cognome'],
							'indirizzo'=>$fattura['indirizzo'],
							'cap'=>$fattura['cap'],
							'comune'=>$fattura['comune'],
							'provincia'=>$fattura['provincia'],
							'codice_fiscale'=>$fattura['codice_fiscale'],
							'partita_iva'=>$fattura['partita_iva'],
							'ID'=>$fattura['id_cliente']
							);
		$ambulatorio = $db->getAmbulatorio('1');
		$prestazioni = $db->getPrestazioni($_GET['id'],1);
		
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->pageHeader($ambulatorio);
		$pdf->Fattura($fattura);
		$pdf->Cliente($cliente);
		$header = array('Descrizione', 'Quantita\'', 'ENPAV', 'IVA', 'Costo');
		$pdf->PrestazioniFattura($header,$prestazioni,$fattura);
		
		$pdf->Output();
	}
	
	else if(isset($_GET['id']) or (isset($_GET['action']) && $_GET['action'] == 'torna'))
	{
		$buttons = array($pagebuttons['stampa'],$pagebuttons['modify'],$pagebuttons['delete'],$pagebuttons['torna_lista'],$pagebuttons['archivio']);

		$fattura = $db->getFattura($_GET['id']);
		
		$ambulatorio = $db->getAmbulatorio($fattura['id_ambulatorio']);
		if($fattura['indirizzo_manuale'] == 0)
			$clienti = $db->getCliente($fattura['id_cliente']);
		else
			$clienti = array('nome'=>$fattura['nome'],
							'cognome'=>$fattura['cognome'],
							'indirizzo'=>$fattura['indirizzo'],
							'cap'=>$fattura['cap'],
							'comune'=>$fattura['comune'],
							'provincia'=>$fattura['provincia'],
							'codice_fiscale'=>$fattura['codice_fiscale'],
							'partita_iva'=>$fattura['partita_iva'],
							'ID'=>$fattura['id_cliente']
							);
		
		$page->drawFattureAmbulatorio('container',$ambulatorio,' - '.$clienti['nome'].' '.$clienti['cognome']);
		$page->drawFattureCliente('tablediv',$clienti, true);
		
		$pazienti = $db->getPaziente($fattura['id_paziente']);
		$page->drawFatturePazienti('tablediv',null,$pazienti);
		
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_GET['id'];
				if(array_key_exists('id_cliente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_cliente']=$fattura['id_cliente'];
			}
		$page->drawTableButtons('tablediv',$buttons,'right');
		
		$prestazioni = $db->getAssocColumns('istanze_prestazioni');
		$prestazione = $db->getPrestazioni($_GET['id'],1);
		$stato = false;
		if($fattura['stato']=='Pagata')
			$stato = true;
		$page->drawPrestazioniFatture('tablediv',$prestazioni,$stato,$prestazione,$fattura['data']);
		
		$fatture = $db->getAssocColumns('fatture');
		$page->drawFattureForm('tablediv',$fatture,$fattura);
		
	}
}

$page->draw();
$db->close_DB();
?>
