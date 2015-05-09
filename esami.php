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
$page = new HTMLEsami();

$pagebuttons = array(
				'nuovo_clinico'=>array('id'=>'nuovo_clinico' , 'type'=>'button' , 'name'=>'Nuovo Esame Clinico' , 'action'=>'nuovo' , 'page'=>'esamiclinici.php' , 'GET_values'=>array('id_paziente'=>'')),
				'nuovo_urine'=>array('id'=>'nuovo_urine' , 'type'=>'button' , 'name'=>'Nuovo Esame Urine' , 'action'=>'nuovo' , 'page'=>'esamiurine.php' , 'GET_values'=>array('id_paziente'=>'')),
				'torna'=>array('id'=>'torna_a_paziente' , 'type'=>'button' , 'name'=>'Torna al paziente' , 'action'=>'torna' , 'page'=>'pazienti.php' , 'GET_values'=>array('id'=>'')),
				'torna_lista'=>array('id'=>'torna_a_lista' , 'type'=>'button' , 'name'=>'Torna a Lista Esami' , 'action'=>'archivio' , 'page'=>'esami.php' , 'GET_values'=>array('id_paziente'=>'')),
				);

$page->drawPage('Esami');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();
	
if (isset($_GET['action']) && isset($_GET['id_paziente']) && $_GET['action'] == 'archivio')
{
	$customs = array('ID','Data','Tipo');
	$esami = $db->getEsami($_GET['id_paziente']);
	
	$buttons = array($pagebuttons['nuovo_clinico'],$pagebuttons['nuovo_urine'],$pagebuttons['torna']);
	foreach($buttons as $key=>$value)
		if($value['GET_values']!=null)
		{
			if(array_key_exists('id',$value['GET_values']))
				$buttons[$key]['GET_values']['id']=$_GET['id_paziente'];
			if(array_key_exists('id_paziente',$value['GET_values']))
				$buttons[$key]['GET_values']['id_paziente']=$_GET['id_paziente'];
		}
		
	$paziente = $db->getPaziente($_GET['id_paziente']);
	$page->drawListEsami('container',$esami,$customs,null,' - '.$paziente['nome']);
	$page->drawTableButtons('container',$buttons,'left');
}

$page->draw();
$db->close_DB();
?>
