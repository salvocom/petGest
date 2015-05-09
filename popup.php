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

$page->drawPage('Cerca');
$page->drawContainer();


if (isset($_GET['action']) && $_GET['action'] == 'cliente')
{
	$customs = array('ID','nome','cognome','mail','telefono_1','telefono_2','telefono_3');
	if (isset($_GET['key']))
		$result = $db->getCustomRows('clienti',$_GET['key'],'cognome',$customs);
	else
		$result = $db->getCustomRows('clienti','A','cognome',$customs);
		
	$page->drawButtonsArchive('popup.php','container','cliente');
	$page->drawList('popup.php','container',$result,$db->getColumns('clienti'),$customs,'cliente');
}

else if (isset($_GET['action']) && $_GET['action'] == 'paziente')
{
	$customs = array('ID','nome','id_microchip','specie','razza','sesso','data_di_nascita');
	if (isset($_GET['key']))
		$result = $db->getCustomRows('pazienti',$_GET['key'],'nome',$customs);
	else
		$result = $db->getCustomRows('pazienti','A','nome',$customs);

	$page->drawButtonsArchive('pazienti.php','container','paziente');
	$page->drawList('pazienti.php','container',$result,$db->getColumns('pazienti'),$customs,'paziente');
}

else if (isset($_GET['action']) && $_GET['action'] == 'ambulatorio')
{
	$customs = array('ID','nome','cognome','partita_iva','indirizzo','citta');
	$result = $db->getCustomRows('ambulatorio','1','ID',$customs);
		
	$page->drawButtonsArchive('popup.php','container','ambulatorio');
	$page->drawList('popup.php','container',$result,$db->getColumns('ambulatorio'),$customs,'ambulatorio');
}

$page->draw();
$db->close_DB();
?>
