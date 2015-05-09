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
$page = new HTMLVaccini();

$cane = array ('Parvo - Cimurro','Polivalente');
$gatto = array ('Leucemia felina','Polivalente','Trivalente');
$coniglio = array ('MEV','Mixomatosi');

$pagebuttons = array(
				'nuovo'=>array('id'=>'nuovo_vaccino' , 'type'=>'button' , 'name'=>'Nuovo Vaccino' , 'action'=>'nuovo' , 'page'=>'vaccini.php' , 'GET_values'=>array('id_paziente'=>'')),
				'nuovo_cucciolo'=>array('id'=>'nuovo_vaccino_cucciolo' , 'type'=>'button' , 'name'=>'Vaccini Cucciolo' , 'action'=>'nuovo_cucciolo' , 'page'=>'vaccini.php' , 'GET_values'=>array('id_paziente'=>'')),
				'nuovo_adulto'=>array('id'=>'nuovo_vaccino_adulto' , 'type'=>'button' , 'name'=>'Vaccini Adulto Scoperto' , 'action'=>'nuovo_adulto' , 'page'=>'vaccini.php' , 'GET_values'=>array('id_paziente'=>'')),
				'sverminazione_cucciolo'=>array('id'=>'sverminazione_cucciolo' , 'type'=>'button' , 'name'=>'Sverminaz. Cucciolo' , 'action'=>'sverminazione_cucciolo' , 'page'=>'vaccini.php' , 'GET_values'=>array('id_paziente'=>'')),
				'sverminazione'=>array('id'=>'nuova_sverminazione' , 'type'=>'button' , 'name'=>'Nuova Sverminaz.' , 'action'=>'sverminazione' , 'page'=>'vaccini.php' , 'GET_values'=>array('id_paziente'=>'')),
				'insert'=>array('id'=>'inserisci_vaccino' , 'type'=>'submit' , 'name'=>'Inserisci' , 'action'=>'insert' , 'page'=>'vaccini.php' , 'GET_values'=>null),
				'modify'=>array('id'=>'modifica_vaccino' , 'type'=>'submit' , 'name'=>'Modifica' , 'action'=>'modify' , 'page'=>'vaccini.php' , 'GET_values'=>null),
				'delete'=>array('id'=>'elimina_vaccino' , 'type'=>'submit' , 'name'=>'Elimina' , 'action'=>'delete' , 'page'=>'vaccini.php' , 'GET_values'=>null),
				'archivio'=>array('id'=>'archivio_vaccini' , 'type'=>'button' , 'name'=>'Archivio Vaccini' , 'action'=>'archivio' , 'page'=>'vaccini.php' , 'GET_values'=>null),
				'torna'=>array('id'=>'torna_a_vaccino' , 'type'=>'button' , 'name'=>'Torna al Vaccino' , 'action'=>'torna' , 'page'=>'vaccini.php' , 'GET_values'=>array('id'=>'')),				
				'torna_paziente'=>array('id'=>'torna_a_paziente' , 'type'=>'button' , 'name'=>'Torna al Paziente' , 'action'=>'torna' , 'page'=>'pazienti.php' , 'GET_values'=>array('id'=>'')),
				'torna_lista'=>array('id'=>'torna_a_lista' , 'type'=>'button' , 'name'=>'Torna a Lista' , 'action'=>'archivio' , 'page'=>'vaccini.php' , 'GET_values'=>array('id_paziente'=>''))
				);

$page->drawPage('Vaccini');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

//Se c'è stato un SUBMIT (Inserimento, Cancellazione o Modifica dati sul DB)
if (!empty($_POST))
{
	if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'insert')
	{	
		for($i=1;$i<5;$i++)
		{
			if(array_key_exists('stato'.$i,$_POST))
			{
				$data = explode('/',$_POST['data_vaccino'.$i]);
				$_POST['data_vaccino'.$i] = "$data[2]-$data[1]-$data[0]";
				
				$data = explode('/',$_POST['data_scadenza'.$i]);
				if(count($data>1))
					$_POST['data_scadenza'.$i] = "$data[2]-$data[1]-$data[0]";
				
				$data = explode('/',$_POST['data_avviso'.$i]);
				if(count($data>1))
					$_POST['data_avviso'.$i] = "$data[2]-$data[1]-$data[0]";
				
				$vaccino = array(
						'tipo'=>$_POST['tipo'.$i],
						'marca'=>$_POST['marca'.$i],
						'durata'=>$_POST['durata'.$i],
						'data_vaccino'=>$_POST['data_vaccino'.$i],
						'data_scadenza'=>$_POST['data_scadenza'.$i],
						'id_paziente'=>$_POST['id_paziente'],
						'avviso'=>$_POST['avviso'.$i],
						'data_avviso'=>$_POST['data_avviso'.$i],
						'stato'=>$_POST['stato'.$i],
						'successivo'=>$_POST['successivo'.$i]
						);
						
				if($_POST['successivo'.$i] == 'SI' and $_POST['stato'.$i] == '2')
				{
					$data = new DateTime($_POST['data_scadenza'.$i]);
					$data->add(new DateInterval('P'.$_POST['durata'.$i].'D'));
					$data_scadenza = $data->format('Y-m-d');
					$data->sub(new DateInterval('P3D'));
					$data_avviso = $data->format('Y-m-d');
					
					$vaccinodopo = array(
						'tipo'=>$_POST['tipo'.$i],
						'marca'=>'',
						'durata'=>$_POST['durata'.$i],
						'data_vaccino'=>$_POST['data_scadenza'.$i],
						'data_scadenza'=>$data_scadenza,
						'id_paziente'=>$_POST['id_paziente'],
						'avviso'=>$_POST['avviso'.$i],
						'data_avviso'=>$data_avviso,
						'stato'=>1,
						'successivo'=>'SI'
						);
					$db->insertRows('vaccini',$vaccinodopo);
				}

				$db->insertRows('vaccini',$vaccino);
			}
		}
		
		$page->drawPar('container','L\'inserimento è avvenuto con successo!');
		
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
		for($i=1;$i<5;$i++)
		{
			if(array_key_exists('stato'.$i,$_POST))
			{
				$data = explode('/',$_POST['data_vaccino'.$i]);
				$_POST['data_vaccino'.$i] = "$data[2]-$data[1]-$data[0]";
				
				$data = explode('/',$_POST['data_scadenza'.$i]);
				if(count($data>1))
					$_POST['data_scadenza'.$i] = "$data[2]-$data[1]-$data[0]";
				
				$data = explode('/',$_POST['data_avviso'.$i]);
				if(count($data>1))
					$_POST['data_avviso'.$i] = "$data[2]-$data[1]-$data[0]";
				
				$vaccino = array(
						'ID'=>$_POST['ID'],
						'tipo'=>$_POST['tipo'.$i],
						'marca'=>$_POST['marca'.$i],
						'durata'=>$_POST['durata'.$i],
						'data_vaccino'=>$_POST['data_vaccino'.$i],
						'data_scadenza'=>$_POST['data_scadenza'.$i],
						'id_paziente'=>$_POST['id_paziente'],
						'avviso'=>$_POST['avviso'.$i],
						'data_avviso'=>$_POST['data_avviso'.$i],
						'stato'=>$_POST['stato'.$i]
						);
						
				if($_POST['successivo'.$i] == 'SI' and $_POST['stato'.$i] == '2')
				{
					$data = new DateTime($_POST['data_scadenza'.$i]);
					$data->add(new DateInterval('P'.$_POST['durata'.$i].'D'));
					$data_scadenza = $data->format('Y-m-d');
					$data->sub(new DateInterval('P3D'));
					$data_avviso = $data->format('Y-m-d');
					
					$vaccinodopo = array(
						'tipo'=>$_POST['tipo'.$i],
						'marca'=>'',
						'durata'=>$_POST['durata'.$i],
						'data_vaccino'=>$_POST['data_scadenza'.$i],
						'data_scadenza'=>$data_scadenza,
						'id_paziente'=>$_POST['id_paziente'],
						'avviso'=>$_POST['avviso'.$i],
						'data_avviso'=>$data_avviso,
						'stato'=>1,
						'successivo'=>'SI'
						);
					$db->insertRows('vaccini',$vaccinodopo);
				}

				$db->updateRows('vaccini',$vaccino);
			}
		}
		
		$page->drawPar('container','La modifica è avvenuta con successo!');
		
		$buttons = array($pagebuttons['torna'],$pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_POST['ID'];
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_POST['id_paziente'];
			}
		$page->drawTableButtons('container',$buttons,'none');
	}
	//Cancellazione
	else if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'delete')
	{
		$db->deleteRows('vaccini',$_POST['ID']);
		$page->drawPar('container','La cancellazione è avvenuta con successo!');
		
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
	//Form per inserimento nuovo vaccino
	if (isset($_GET['action']) and $_GET['action'] == 'nuovo_cucciolo' and isset($_GET['id_paziente']))
	{	
		$vaccini = $db->getAssocColumns('vaccini');
		$paziente = $db->getPaziente($_GET['id_paziente']);
		
		if($paziente['specie'] == 'Canina')
		{
			$page->drawVaccinoSchema('container','cucciolo',$vaccini,$paziente,null);
			for($i=1;$i<5;$i++)
				$page->drawVacciniOption('tipo_options'.$i,$cane,false,null);
		}
		else if($paziente['specie'] == 'Felina')
		{
			$page->drawVaccinoSchema('container','cucciolo',$vaccini,$paziente,null);
			for($i=1;$i<4;$i++)
				$page->drawVacciniOption('tipo_options'.$i,$gatto,false,null);
		}
		else if($paziente['specie'] == 'Leporide')
		{
			$page->drawVaccinoSchema('container','cucciolo',$vaccini,$paziente,null);
			for($i=1;$i<2;$i++)
				$page->drawVacciniOption('tipo_options'.$i,$coniglio,false,null);
		}
				
		$buttons = array($pagebuttons['insert'],$pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_GET['id_paziente'];
			}
		
		$page->drawTableButtons('container',$buttons,'left');
	}
	if (isset($_GET['action']) and $_GET['action'] == 'nuovo_adulto' and isset($_GET['id_paziente']))
	{	
		$vaccini = $db->getAssocColumns('vaccini');
		$paziente = $db->getPaziente($_GET['id_paziente']);
		
		if($paziente['specie'] == 'Canina')
		{
			$page->drawVaccinoSchema('container','adulto',$vaccini,$paziente,null);
			for($i=1;$i<4;$i++)
				$page->drawVacciniOption('tipo_options'.$i,$cane,false,null);
		}
		else if($paziente['specie'] == 'Felina')
		{
			$page->drawVaccinoSchema('container','adulto',$vaccini,$paziente,null);
			for($i=1;$i<5;$i++)
				$page->drawVacciniOption('tipo_options'.$i,$gatto,false,null);
		}
		else if($paziente['specie'] == 'Leporide')
		{
			$page->drawVaccinoSchema('container','adulto',$vaccini,$paziente,null);
			for($i=1;$i<2;$i++)
				$page->drawVacciniOption('tipo_options'.$i,$coniglio,false,null);
		}
				
		$buttons = array($pagebuttons['insert'],$pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_GET['id_paziente'];
			}
		
		$page->drawTableButtons('container',$buttons,'left');
	}
	else if (isset($_GET['action']) and $_GET['action'] == 'nuovo' and isset($_GET['id_paziente']))
	{	
		$vaccini = $db->getAssocColumns('vaccini');
		$paziente = $db->getPaziente($_GET['id_paziente']);
		
		$page->drawVaccino('container',$vaccini,$paziente,null);
		
		if($paziente['specie'] == 'Canina')
			$page->drawVacciniOption('tipo_options1',$cane,false,null);
		else if($paziente['specie'] == 'Felina')
			$page->drawVacciniOption('tipo_options1',$gatto,false,null);
		else if($paziente['specie'] == 'Leporide')
			$page->drawVacciniOption('tipo_options1',$coniglio,false,null);
				
		$buttons = array($pagebuttons['insert'],$pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_GET['id_paziente'];
			}
		
		$page->drawTableButtons('container',$buttons,'left');
	}
	else if (isset($_GET['action']) and $_GET['action'] == 'sverminazione' and isset($_GET['id_paziente']))
	{	
		$vaccini = $db->getAssocColumns('vaccini');
		$paziente = $db->getPaziente($_GET['id_paziente']);
		
		$page->drawSverminazione('container',$vaccini,$paziente,null);
				
		$buttons = array($pagebuttons['insert'],$pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_GET['id_paziente'];
			}
		
		$page->drawTableButtons('container',$buttons,'left');
	}
	else if (isset($_GET['action']) and $_GET['action'] == 'sverminazione_cucciolo' and isset($_GET['id_paziente']))
	{	
		$vaccini = $db->getAssocColumns('vaccini');
		$paziente = $db->getPaziente($_GET['id_paziente']);
		
		$page->drawSverminazioneCucciolo('container',$vaccini,$paziente,null);
				
		$buttons = array($pagebuttons['insert'],$pagebuttons['torna_lista']);
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_GET['id_paziente'];
			}
		
		$page->drawTableButtons('container',$buttons,'left');
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'archivio' and isset($_GET['id_paziente']))
	{
		$customs = array('ID','tipo','durata','data_vaccino','data_scadenza','stato');
		$result = $db->getCustomVaccini('vaccini',$_GET['id_paziente'],'id_paziente',$customs);
		
		$buttons = array($pagebuttons['nuovo'],$pagebuttons['sverminazione'],$pagebuttons['nuovo_cucciolo'],
					$pagebuttons['nuovo_adulto'],$pagebuttons['sverminazione_cucciolo'],$pagebuttons['torna_paziente']);
		
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_GET['id_paziente'];
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$_GET['id_paziente'];
			}
		
		$page->drawList('vaccini.php','container',$result,$db->getColumns('vaccini'),$customs);
		$page->drawTableButtons('container',$buttons,'left');
	}
	else if(isset($_GET['id']) or (isset($_GET['action']) && $_GET['action'] == 'torna'))
	{
		$buttons = array($pagebuttons['modify'],$pagebuttons['delete'],$pagebuttons['torna_lista']);

		$result = $db->getVaccino($_GET['id']);
		$paziente = $db->getPaziente($result['id_paziente']);
		$vaccini = $db->getAssocColumns('vaccini');
		
		$page->drawVaccino('container',$vaccini,$paziente,$result);
		
		if($paziente['specie'] == 'Canina')
			$page->drawVacciniOption('tipo_options1',$cane,false,null);
		else if($paziente['specie'] == 'Felina')
			$page->drawVacciniOption('tipo_options1',$gatto,false,null);
		else if($paziente['specie'] == 'Leporide')
			$page->drawVacciniOption('tipo_options1',$coniglio,false,null);
		
		foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
			{
				if(array_key_exists('id',$value['GET_values']))
					$buttons[$key]['GET_values']['id']=$_GET['id'];
				if(array_key_exists('id_paziente',$value['GET_values']))
					$buttons[$key]['GET_values']['id_paziente']=$result['id_paziente'];
			}
		$page->drawTableButtons('container',$buttons,'left');
	}
}

$page->draw();
$db->close_DB();
?>
