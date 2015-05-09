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

$pagebuttons = array(
				'modify'=>array('id'=>'modifica_ambulatorio' , 'type'=>'submit' , 'name'=>'Modifica Dati Ambulatorio' , 'action'=>'modify' , 'page'=>'ambulatorio.php' , 'GET_values'=>array('id'=>''))
				);

$page->drawPage('Ambulatorio');
$page->drawHeader();
$page->drawMenu();
$page->drawContainer();

//Se c'è stato un SUBMIT (Inserimento, Cancellazione o Modifica dati sul DB)
if (!empty($_POST))
{
	//Modifica
	if(isset($_POST['actionDB']) and $_POST['actionDB'] == 'modify')
	{
		$fields = null;
		foreach($_POST as $key=>$value)
		{
			if ($key != 'actionDB')
				$fields[$key] = $value;
		}
		
		if($db->updateRows('ambulatorio',$fields))
			$page->drawPar('container','La modifica è avvenuta con successo!');
		else
			$page->drawPar('container','Modifica non riuscita : ' . mysql_error());
		
		$buttons = array($pagebuttons['modify']);
	
		$columns = $db->getColumns('ambulatorio');
		$result = $db->getRows('ambulatorio','1','ID');
	
		$page->drawFormTable('container','ambulatorio.php',$columns,$result);
		$page->drawTableButtons('container',$buttons,'left');
	}
}

//Pagina Ambulatorio
else
{
	$buttons = array($pagebuttons['modify']);
	foreach($buttons as $key=>$value)
			if($value['GET_values']!=null)
				$buttons[$key]['GET_values']['id']='1';
	
	$columns = $db->getColumns('ambulatorio');
	$result = $db->getRows('ambulatorio','1','ID');
	
	$page->drawFormTable('container','ambulatorio.php',$columns,$result);
	$page->drawTableButtons('container',$buttons,'left');
}

$page->draw();
$db->close_DB();

?>
