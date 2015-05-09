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
$page = new HTMLEsamiClinici();


$select = array(
'ambiente_di_vita' => array('all\'aperto','appartamento','misto'),
'appetito' => array('normale','poco','molto','anoressico','disoressico'),
'consumo_acqua' => array('normale','poco','molto'),
'feci' => array('normali','acquose','diarroiche','dure','gassose','nastriformi'),
'urine' => array('normali','concentrate','diluite','con sangue'),
'regime_alimentare' => array('casalingo','industriale secco','industriale umido','misto indust./casal.','misto secco/umido'),
'nutrizione' => array('normopeso','sottopeso','sovrappeso'),
'cute' => array('normale','unta','disidratata'),
'narici' => array('normali','scolo sieroso','scolo purulento','scolo mucoso','scolo emorragico','fessurazioni','epistassi'),
'mucose_oculari' => array('normali','anemiche','congeste','itteriche','cianotiche','ulcerate'),
'mucose_orali' => array('normali','anemiche','congeste','itteriche','cianotiche','ulcerate'),
'denti' => array('normali','tartaro','tartaro e stomatite','canini decidui'),
'linfonodi' => array('normali','iperplasici','ipoplasici','megalici','poplitei megalici','prescapolari megalici'),
'orecchie' => array('normali','concentrate','diluite','con sangue'),
'polso' => array('normale','sottile','duro','molle','aritmico'),
'cuore' => array('normale','soffio lieve','soffio moderato','soffio grave'),
'respiro' => array('normale','iperpnea','ortopnea','polipnea','tachipnea'),
'palpazione_addome' => array('normale','impraticabile','dolente'),
'palpazione_mammelle' => array('normale','dolente','produzione di siero','produzione di latte','neoformazioni','ulcerazioni'),
'palpazione_testicoli' => array('normale','criptoorchide','impraticabile','neoformazioni'),
'stato_del_sensorio' => array('normale','comatoso','depresso','eccitato','ottuso','vigile')
);

$pagebuttons = array(
				'insert'=>array('id'=>'inserisci_esame' , 'type'=>'submit' , 'name'=>'Inserisci esame' , 'action'=>'insert' , 'page'=>'esamiclinici.php' , 'GET_values'=>null),
				'modify'=>array('id'=>'modifica_esame' , 'type'=>'submit' , 'name'=>'Modifica esame' , 'action'=>'modify' , 'page'=>'esamiclinici.php' , 'GET_values'=>null),
				'delete'=>array('id'=>'elimina_esame' , 'type'=>'submit' , 'name'=>'Elimina esame' , 'action'=>'delete' , 'page'=>'esamiclinici.php' , 'GET_values'=>null),
				'torna'=>array('id'=>'torna_a_paziente' , 'type'=>'button' , 'name'=>'Torna al paziente' , 'action'=>'torna' , 'page'=>'pazienti.php' , 'GET_values'=>array('id'=>'')),
				'stampa'=>array('id'=>'stampa_esame' , 'type'=>'button' , 'name'=>'Stampa Esame' , 'action'=>'stampa' , 'page'=>'esamiclinici.php' , 'GET_values'=>array('id'=>'')),
				'torna_lista'=>array('id'=>'torna_a_lista' , 'type'=>'button' , 'name'=>'Torna a Lista Esami' , 'action'=>'archivio' , 'page'=>'esami.php' , 'GET_values'=>array('id_paziente'=>'')),
				);

$page->drawPage('esamiclinici');
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
		
		$anamnesi = array(
						'id_paziente'=>$_POST['id_paziente'],
						'ambiente_di_vita'=>$_POST['ambiente_di_vita'],
						'appetito'=>$_POST['appetito'],
						'consumo_acqua'=>$_POST['consumo_acqua'],
						'feci'=>$_POST['feci'],
						'urine'=>$_POST['urine'],
						'altri_animali'=>$_POST['altri_animali'],
						'sverminazione'=>$_POST['sverminazione'],
						'vaccinazione'=>$_POST['vaccinazione'],
						'regime_alimentare'=>$_POST['regime_alimentare'],
						'terapie'=>$_POST['terapie'],
						'data'=>$_POST['data']
						);
		
		if($db->insertRows('esami_generali',$anamnesi))
		{
			$id_esame = $db->getLastID('esami_generali');
			
			$clinico = array(
						'ID'=>$id_esame,
						'id_paziente'=>$_POST['id_paziente'],
						'nutrizione'=>$_POST['nutrizione'],
						'cute'=>$_POST['cute'],
						'narici'=>$_POST['narici'],
						'mucose_oculari'=>$_POST['mucose_oculari'],
						'mucose_orali'=>$_POST['mucose_orali'],
						'denti'=>$_POST['denti'],
						'linfonodi'=>$_POST['linfonodi'],
						'orecchie'=>$_POST['orecchie'],
						'polso'=>$_POST['polso'],
						'cuore'=>$_POST['cuore'],
						'respiro'=>$_POST['respiro'],
						'palpazione_addome'=>$_POST['palpazione_addome'],
						'palpazione_mammelle'=>$_POST['palpazione_mammelle'],
						'palpazione_testicoli'=>$_POST['palpazione_testicoli'],
						'stato_del_sensorio'=>$_POST['stato_del_sensorio'],
						'temperatura'=>$_POST['temperatura'],
						'peso'=>$_POST['peso'],
						'note'=>$_POST['note'],
						'data'=>$_POST['data']
						);
			if($db->insertRows('esami_clinici',$clinico))
				$page->drawPar('container','L\'inserimento è avvenuto con successo!');
			else
				$page->drawPar('container','Inserimento non riuscito : ' . mysql_error());
		}
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
		
		$anamnesi = array(
						'ID'=>$_POST['ID'],
						'id_paziente'=>$_POST['id_paziente'],
						'ambiente_di_vita'=>$_POST['ambiente_di_vita'],
						'appetito'=>$_POST['appetito'],
						'consumo_acqua'=>$_POST['consumo_acqua'],
						'feci'=>$_POST['feci'],
						'urine'=>$_POST['urine'],
						'altri_animali'=>$_POST['altri_animali'],
						'sverminazione'=>$_POST['sverminazione'],
						'vaccinazione'=>$_POST['vaccinazione'],
						'regime_alimentare'=>$_POST['regime_alimentare'],
						'terapie'=>$_POST['terapie'],
						'data'=>$_POST['data']
						);
		
		if($db->updateRows('esami_generali',$anamnesi))
		{	
			$clinico = array(
						'ID'=>$_POST['ID'],
						'id_paziente'=>$_POST['id_paziente'],
						'nutrizione'=>$_POST['nutrizione'],
						'cute'=>$_POST['cute'],
						'narici'=>$_POST['narici'],
						'mucose_oculari'=>$_POST['mucose_oculari'],
						'mucose_orali'=>$_POST['mucose_orali'],
						'denti'=>$_POST['denti'],
						'linfonodi'=>$_POST['linfonodi'],
						'orecchie'=>$_POST['orecchie'],
						'polso'=>$_POST['polso'],
						'cuore'=>$_POST['cuore'],
						'respiro'=>$_POST['respiro'],
						'palpazione_addome'=>$_POST['palpazione_addome'],
						'palpazione_mammelle'=>$_POST['palpazione_mammelle'],
						'palpazione_testicoli'=>$_POST['palpazione_testicoli'],
						'stato_del_sensorio'=>$_POST['stato_del_sensorio'],
						'temperatura'=>$_POST['temperatura'],
						'peso'=>$_POST['peso'],
						'note'=>$_POST['note'],
						'data'=>$_POST['data']
						);
			if($db->updateRows('esami_clinici',$clinico))
				$page->drawPar('container','La modifica è avvenuta con successo!');
			else
				$page->drawPar('container','Modifica non riuscita : ' . mysql_error());
		}
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
		if($db->deleteRow('esami_generali',$_POST['ID']))
		{
			if($db->deleteRow('esami_clinici',$_POST['ID']))
				$page->drawPar('container','La cancellazione è avvenuta con successo!');
		}
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
		$anamnesi = $db->getAssocColumns('esami_generali');
		$clinici = $db->getAssocColumns('esami_clinici');
		$page->drawAnamnesi('container',$anamnesi,$clinici,$paziente);
		
		foreach ($select as $tempkey => $tempvalue)
			$page->drawEsamiOption($tempkey.'_options',$tempvalue,false);
		
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
		$esame = $db->getEsameGenerale($_GET['id']);
		$ambulatorio = $db->getAmbulatorio('1');
		$paziente = $db->getPaziente($esame['id_paziente']);
		$cliente = $db->getCliente($paziente['id_cliente']);
		
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->pageHeader($ambulatorio);
		$pdf->Cliente($cliente);
		
		$pdf->Output();
	}
	
	else if(isset($_GET['id']) or (isset($_GET['action']) && $_GET['action'] == 'torna'))
	{
		$buttons = array($pagebuttons['modify'],$pagebuttons['delete'],$pagebuttons['stampa'],$pagebuttons['torna_lista']);
		
		$generale = $db->getEsameGenerale($_GET['id']);
		$clinico = $db->getEsameClinico($_GET['id']);
				
		$paziente = $db->getPaziente($generale['id_paziente']);
		$anamnesi = $db->getAssocColumns('esami_generali');
		$clinici = $db->getAssocColumns('esami_clinici');
		$page->drawAnamnesi('container',$anamnesi,$clinici,$paziente,$generale,$clinico);
		
		foreach ($select as $tempkey => $tempvalue)
		{
			if(array_key_exists($tempkey,$generale))
				$page->drawEsamiOption($tempkey.'_options',$tempvalue,true,$generale[$tempkey]);
			else if(array_key_exists($tempkey,$clinico))
				$page->drawEsamiOption($tempkey.'_options',$tempvalue,true,$clinico[$tempkey]);
		}
		
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_GET['id'];
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$generale['id_paziente'];
			}
		$page->drawTableButtons('container',$buttons,'left');
		
	}
}

$page->draw();
$db->close_DB();
?>
