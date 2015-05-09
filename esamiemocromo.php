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
$page = new HTMLEsamiEmocromo();

$pagebuttons = array(
				'insert'=>array('id'=>'inserisci_esame' , 'type'=>'submit' , 'name'=>'Inserisci esame' , 'action'=>'insert' , 'page'=>'esamiemocromo.php' , 'GET_values'=>null),
				'modify'=>array('id'=>'modifica_esame' , 'type'=>'submit' , 'name'=>'Modifica esame' , 'action'=>'modify' , 'page'=>'esamiemocromo.php' , 'GET_values'=>null),
				'delete'=>array('id'=>'elimina_esame' , 'type'=>'submit' , 'name'=>'Elimina esame' , 'action'=>'delete' , 'page'=>'esamiemocromo.php' , 'GET_values'=>null),
				'torna'=>array('id'=>'torna_a_paziente' , 'type'=>'button' , 'name'=>'Torna al paziente' , 'action'=>'torna' , 'page'=>'pazienti.php' , 'GET_values'=>array('id'=>'')),
				'stampa'=>array('id'=>'stampa_esame' , 'type'=>'button' , 'name'=>'Stampa Esame' , 'action'=>'stampa' , 'page'=>'esamiemocromo.php' , 'GET_values'=>array('id'=>'')),
				'torna_lista'=>array('id'=>'torna_a_lista' , 'type'=>'button' , 'name'=>'Torna a Lista Esami' , 'action'=>'archivio' , 'page'=>'esami.php' , 'GET_values'=>array('id_paziente'=>'')),
				);

$page->drawPage('esamiemocromo');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

//Se c'è stato un SUBMIT (Inserimento, Cancellazione o Modifica dati sul DB)
if (!empty($_POST))
{
	//Inserimento
	if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'insert')
	{	
		$data = explode('/',$_POST['data']);
		$_POST['data'] = "$data[2]-$data[1]-$data[0]";
		
		$emocromo = array(
						'id_paziente'=>$_POST['id_paziente'],
						'RBC'=>$_POST['RBC'],
						'Hb'=>$_POST['Hb'],
						'Hct'=>$_POST['Hct'],
						'MCV'=>$_POST['MCV'],
						'MCH'=>$_POST['MCH'],
						'MCHC'=>$_POST['MCHC'],
						'RDW'=>$_POST['RDW'],
						'WBC'=>$_POST['WBC'],
						'LYM'=>$_POST['LYM'],
						'MON'=>$_POST['MON'],
						'GRA'=>$_POST['GRA'],
						'LYM_per'=>$_POST['LYM_per'],
						'MON_per'=>$_POST['MON_per'],
						'GRA_per'=>$_POST['GRA_per'],
						'PLT'=>$_POST['PLT'],
						'MPV'=>$_POST['MPV'],
						'note'=>$_POST['note'],
						'data'=>$_POST['data']
						);
		
		if($db->insertRows('esami_emocromo',$emocromo))
			$page->drawPar('container','L\'inserimento è avvenuto con successo!');
		else
			$page->drawPar('container','Inserimento non riuscito : ' . mysql_error());
		
		$buttons = array($pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_POST['id_paziente'];
			}
		$page->drawTableButtons('container',$buttons,'none');
	}
	//Modifica
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'modify')
	{
		$data = explode('/',$_POST['data']);
		$_POST['data'] = "$data[2]-$data[1]-$data[0]";
		
		$emocromo = array(
						'ID'=>$_POST['ID'],
						'id_paziente'=>$_POST['id_paziente'],
						'RBC'=>$_POST['RBC'],
						'Hb'=>$_POST['Hb'],
						'Hct'=>$_POST['Hct'],
						'MCV'=>$_POST['MCV'],
						'MCH'=>$_POST['MCH'],
						'MCHC'=>$_POST['MCHC'],
						'RDW'=>$_POST['RDW'],
						'WBC'=>$_POST['WBC'],
						'LYM'=>$_POST['LYM'],
						'MON'=>$_POST['MON'],
						'GRA'=>$_POST['GRA'],
						'LYM_per'=>$_POST['LYM_per'],
						'MON_per'=>$_POST['MON_per'],
						'GRA_per'=>$_POST['GRA_per'],
						'PLT'=>$_POST['PLT'],
						'MPV'=>$_POST['MPV'],
						'note'=>$_POST['note'],
						'data'=>$_POST['data']
						);
		
		if($db->updateRows('esami_emocromo',$emocromo))
			$page->drawPar('container','La modifica è avvenuta con successo!');
		else
			$page->drawPar('container','Modifica non riuscita : ' . mysql_error());
		
		$buttons = array($pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_POST['id_paziente'];
			}
		$page->drawTableButtons('container',$buttons,'none');
	}
	//Cancellazione
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'delete')
	{	
		if($db->deleteRow('esami_emocromo',$_POST['ID']))
			$page->drawPar('container','La cancellazione è avvenuta con successo!');
		else
			$page->drawPar('container','Cancellazione non riuscita : ' . mysql_error());
		
		$buttons = array($pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_POST['id_paziente'];
			}
		$page->drawTableButtons('container',$buttons,'none');
	}
}

//Se è stato cliccato un bottone
else
{
	//Form per inserimento nuovo preventivo
	if (isset($_GET['action']) && $_GET['action'] == 'nuovo' && isset($_GET['id_paziente']))
	{
		$buttons = array($pagebuttons['insert'],$pagebuttons['torna_lista']);
		
		$paziente = $db->getPaziente($_GET['id_paziente']);
		$emocromo = $db->getAssocColumns('esami_emocromo');
		$page->drawEsameEmocromo('container',$emocromo,$paziente);
		
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_GET['id_paziente'];
			}
		$page->drawTableButtons('container',$buttons,'left');		
	}
	
	else if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'stampa')
	{	
		$esame = $db->getEsameEmocromo($_GET['id']);
		$ambulatorio = $db->getAmbulatorio('1');
		$paziente = $db->getPaziente($esame['id_paziente']);
		$cliente = $db->getCliente($paziente['id_cliente']);
		
		$pdf = new PDFEsamiEmocromo();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->pageHeader($ambulatorio);
		$pdf->EsameEmocromo($cliente,$paziente,$esame);
		
		$pdf->Output();
	}
	
	else if(isset($_GET['id']) or (isset($_GET['action']) && $_GET['action'] == 'torna'))
	{
		$buttons = array($pagebuttons['modify'],$pagebuttons['delete'],$pagebuttons['stampa'],$pagebuttons['torna_lista']);
		
		$esame = $db->getEsameEmocromo($_GET['id']);
				
		$paziente = $db->getPaziente($esame['id_paziente']);
		$emocromo = $db->getAssocColumns('esami_emocromo');
		
		$page->drawEsameEmocromo('container',$emocromo,$paziente,$esame);
		
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_GET['id'];
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$esame['id_paziente'];
			}
		$page->drawTableButtons('container',$buttons,'left');
		
	}
}

$page->draw();
$db->close_DB();
?>
