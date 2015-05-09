<?

class HTML
{
	protected $html;
	protected $htmlDom;
	
	function __construct() 
	{
		$domImpl = new DOMImplementation();
		$doctype = $domImpl->createDocumentType('html',
					'-//W3C//DTD XHTML 1.0 Strict//EN',
					'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd');
 
		$this->htmlDom = $domImpl->createDocument('http://www.w3.org/1999/xhtml',
					'html',
					$doctype);
		$this->htmlDom->formatOutput = true;
		$this->html = $this->htmlDom->documentElement;
					
	}

	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawPage($namePage)
	{
		$this->drawHead($namePage);
		$body = $this->html->appendChild(new DOMElement('body'));
		$body->setAttribute('id','body');
		$form = $body->appendChild(new DOMElement('form'));
		$form->setAttribute('id','form');
		$form->setAttribute('name','form');
		$form->setAttribute('action',strtolower(substr($namePage,0,1)).substr($namePage,1).'.php');
		$form->setAttribute('method','POST');
		
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawHead($namePage)
	{
		$head = $this->html->appendChild(new DOMElement('head'));
				
		$contentType = $head->appendChild(new DOMElement('meta'));
		$contentType->setAttribute('http-equiv','content-type');
		$contentType->setAttribute('content','text/html');
		$contentType->setAttribute('charset','utf-8');
		
		$head->appendChild(new DOMElement('title','PetGest 1.0 - Gestione Abulatorio Veterinario | '.$namePage));
		
		$keywords = $head->appendChild(new DOMElement('meta'));
		$keywords->setAttribute('name','keywords');
		$keywords->setAttribute('content','');
		
		$desc = $head->appendChild(new DOMElement('meta'));
		$desc->setAttribute('name','description');
		$desc->setAttribute('content','');
		
		$jquery = $head->appendChild(new DOMElement('script'));
		$jquery->setAttribute('src','js/jquery-1.7.2.js');
		$jquery2 = $head->appendChild(new DOMElement('script'));
		$jquery2->setAttribute('src','js/jquery-1.7.2.min.js');
		$js = $head->appendChild(new DOMElement('script'));
		$js->setAttribute('src','js/jquery.ui.core.js');
		$js1 = $head->appendChild(new DOMElement('script'));
		$js1->setAttribute('src','js/jquery.ui.widget.js');
		$js2 = $head->appendChild(new DOMElement('script'));
		$js2->setAttribute('src','js/jquery.ui.datepicker.js');
		$js3 = $head->appendChild(new DOMElement('script'));
		$js3->setAttribute('src','js/jquery.ui.datepicker-it.js');
		$js5 = $head->appendChild(new DOMElement('script'));
		$js5->setAttribute('src','js/jquery.bgiframe-2.1.2.js');
		$js6 = $head->appendChild(new DOMElement('script'));
		$js6->setAttribute('src','js/jquery.ui.mouse.js');
		$js7 = $head->appendChild(new DOMElement('script'));
		$js7->setAttribute('src','js/jquery.ui.draggable.js');
		$js8 = $head->appendChild(new DOMElement('script'));
		$js8->setAttribute('src','js/jquery.ui.position.js');
		$js9 = $head->appendChild(new DOMElement('script'));
		$js9->setAttribute('src','js/jquery.ui.resizable.js');
		$js10 = $head->appendChild(new DOMElement('script'));
		$js10->setAttribute('src','js/jquery.ui.dialog.js');
		$js11 = $head->appendChild(new DOMElement('script'));
		$js11->setAttribute('src','js/checkFunctions.js');
		
		$link = $head->appendChild(new DOMElement('link'));
		$link->setAttribute('href','style.css');
		$link->setAttribute('rel','stylesheet');
		$link->setAttribute('type','text/css');
		$link->setAttribute('media','screen');
		
		$link2 = $head->appendChild(new DOMElement('link'));
		$link2->setAttribute('href','jquery-ui-1.8.19.custom.css');
		$link2->setAttribute('rel','stylesheet');
		$link2->setAttribute('type','text/css');
		$link2->setAttribute('media','screen');

	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawHeader()
	{
		$body = $this->getElementById('form');
		$header = $body->appendChild(new DOMElement('div'));
		$header->setAttribute('id','header');
		
		$header_content = $header->appendChild(new DOMElement('div'));
		$header_content->setAttribute('id','header-content');
		
		$header_content->appendChild(new DOMElement('h1','petGest 1.0'));
		$header_content->appendChild(new DOMElement('br'));
		$par = $header_content->appendChild(new DOMElement('p'));
		$par->appendChild(new DOMElement('em','Gestione Ambulatorio Veterinario'));
		
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawContainer()
	{
		$parent = $this->getElementById('form');
		$container = $parent->appendChild(new DOMElement('div'));
		$container->setAttribute('id','container');
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawMenu()
	{
		$elements = array('Home'=>'index.php',
							//'Gestione Ambulatorio'=>array('Dati Ambulatorio'=>'ambulatorio.php','Agenda Visite'=>'visite.php','Registro Farmaci'=>'farmaci.php'),
							'Clienti'=>'clienti.php',
							'Pazienti'=>'pazienti.php',
							//'Fornitori'=>'fornitori.php',
							'Gestione Fatture'=>'fatture.php',
							'Fornitori'=>'fornitori.php',
							'Mail'=>'mailto.php'
							);
		
		$parent = $this->getElementById('header');
		$menu = $parent->appendChild(new DOMElement('div'));
		$menu->setAttribute('id','menu');
		$undermenu = $parent->appendChild(new DOMElement('div'));
		$undermenu->setAttribute('id','undermenu');
		$ul = $menu->appendChild(new DOMElement('ul'));
		foreach($elements as $key=>$elem)
		{
			if (is_array($elem))
			{	
				$li = $ul->appendChild(new DOMElement('li'));
				$a = $li->appendChild(new DOMElement('a',$key));
				$a->setAttribute('href','#');
								
				$undermenucode = '<ul>';
				$i=1;
				foreach($elem as $underkey=>$underelem)
				{
					if($i==1)
						$undermenucode.='<li class=\'left\'><a href=\''.$underelem.'\'>'.$underkey.'</a></li>';
					else if($i==count($elem))
						$undermenucode.='<li class=\'right\'><a href=\''.$underelem.'\'>'.$underkey.'</a></li>';
					else
						$undermenucode.='<li><a href=\''.$underelem.'\'>'.$underkey.'</a></li>';
					$i++;
				}
				$undermenucode.='</ul>';
				
				$a->setAttribute('onclick','document.getElementById(\'undermenu\').innerHTML = '.$undermenucode.';');
			}
			else
			{
				$li = $ul->appendChild(new DOMElement('li'));
				$a = $li->appendChild(new DOMElement('a',$key));
				$a->setAttribute('href',$elem);
				$a->setAttribute('name',strtolower($key));
				$a->setAttribute('id',strtolower($key));
			}
		}

	}

	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawFormTable($container,$page,$results,$rows = null,$id = null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode(strtoupper(substr($page,0,1)).str_replace('.php','',substr($page,1))));
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('id','formtab');
		
		//Crea la tabella per il form in modifica o inserimento
		$modify = false;
		if(!is_null($rows))
		{
			//Se in modifica legge i dati presenti sul DB
			$modify = true;
			$row = mysql_fetch_assoc($rows);
		}
		
		if($id != null)
			$idvalue=explode('#',$id);
		
		foreach($results as $key=>$value)
		{
			if(strtolower($value['name']) == 'id' and $modify)
			{
				$tr = $table->appendChild(new DOMElement('tr'));
				
				$td = $tr->appendChild(new DOMElement('td'));
				$input = $td->appendChild(new DOMElement('input'));
				$input->setAttribute('type','hidden');
				$input->setAttribute('id',$value['name']);
				$input->setAttribute('name',$value['name']);
				$input->setAttribute('value',$row[$value['name']]);
			}
			else if(strpos(strtolower($value['name']), 'id') !== false and strtolower($value['name']) != 'id')
			{
				$tr = $table->appendChild(new DOMElement('tr'));
					
				$td = $tr->appendChild(new DOMElement('td'));
				$p = $td->appendChild(new DOMElement('p'));
				$p->appendChild($this->htmlDom->createTextNode($value['layout']));
				
				$td = $tr->appendChild(new DOMElement('td'));
				$input = $td->appendChild(new DOMElement('input'));
				$input->setAttribute('type','text');
				$input->setAttribute('id',$value['name']);
				$input->setAttribute('name',$value['name']);
				$input->setAttribute('size',$value['size']);
				$input->setAttribute('maxlength',$value['size']);
				if($modify)
					$input->setAttribute('value',$row[$value['name']]);
				if($id != null and $idvalue[0] == $value['name'])
					$input->setAttribute('value',$idvalue[1]);
				
				$popuppage = str_replace('id_','',strtolower($value['name']));
				$td = $tr->appendChild(new DOMElement('td'));
				$button = $td->appendChild(new DOMElement('input'));
				$button->setAttribute('type','button');
				$button->setAttribute('value','Cerca '.$popuppage);
				$button->setAttribute('onclick','window.open(\'popup.php?action='.$popuppage.'\',\'popuppage\',\'width=850,toolbar=1,resizable=1,scrollbars=yes,height=700,top=100,left=100\');');
				
			}
			else if(strtolower($value['name']) != 'id')
			{	
				$tr = $table->appendChild(new DOMElement('tr'));
					
				$td = $tr->appendChild(new DOMElement('td'));
				$p = $td->appendChild(new DOMElement('p'));
				$p->appendChild($this->htmlDom->createTextNode($value['layout']));
				
				if($value['type'] == 'varchar' || $value['type'] == 'int')
				{
					if($value['name'] == 'razza')
					{
						$td = $tr->appendChild(new DOMElement('td'));
						$select = $td->appendChild(new DOMElement('select'));
						$select->setAttribute('name',$value['name']);
						$select->setAttribute('id',$value['name']);
					}
					else
					{
						$td = $tr->appendChild(new DOMElement('td'));
						$input = $td->appendChild(new DOMElement('input'));
						$input->setAttribute('type','text');
						$input->setAttribute('id',$value['name']);
						$input->setAttribute('name',$value['name']);
						$input->setAttribute('size',$value['size']+1);
						$input->setAttribute('maxlength',$value['size']);
						if($modify)
							$input->setAttribute('value',$row[$value['name']]);
					}
				}
				if($value['type'] == 'date')
				{
					$td = $tr->appendChild(new DOMElement('td'));
					$input = $td->appendChild(new DOMElement('input'));
					$input->setAttribute('type','text');
					$input->setAttribute('id','datepicker');
					$input->setAttribute('name',$value['name']);
					$input->setAttribute('size','11');
					$input->setAttribute('maxlength','10');
					if($modify)
						$input->setAttribute('value',$row[$value['name']]);
				}
				if($value['type'] == 'text')
				{
					$td = $tr->appendChild(new DOMElement('td'));
					$textarea = $td->appendChild(new DOMElement('textarea'));
					$textarea->setAttribute('id',$value['name']);
					$textarea->setAttribute('name',$value['name']);
					if($modify)
						$textarea->appendChild($this->htmlDom->createTextNode($row[$value['name']]));
				}
				if($value['type'] == 'set' or $value['type'] == 'enum')
				{
					$elements = $value['value'];

					$td = $tr->appendChild(new DOMElement('td'));
					$select = $td->appendChild(new DOMElement('select'));
					$select->setAttribute('name',$value['name']);
					$select->setAttribute('id',$value['name']);
					if($value['name'] == 'specie')
						$select->setAttribute('onchange','setrazza(this)');
					foreach($elements as $elem)
					{
						$option = $select->appendChild(new DOMElement('option'));
						$option->setAttribute('value',str_replace('\'','',$elem));
						$option->appendChild($this->htmlDom->createTextNode(str_replace('\'','',$elem)));

						if($modify)
							if($row[$value['name']] == str_replace('\'','',$elem))
									$option->setAttribute('selected','selected');
					}
				}
			}
		}
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','hidden');
		$input->setAttribute('id','actionDB');
		$input->setAttribute('name','actionDB');
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawSearch($container,$page,$text)
	{
		$div = $this->getElementById($container);
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('id','search');
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$h3 = $td->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode($text));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','cerca');
		$input->setAttribute('name','cerca');
	}
	

	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawTableButtons($container,$elements,$float)
	{
		$div1 = $this->getElementById($container);
		$div = $div1->appendChild(new DOMElement('div'));
		if ($float == 'left')
			$div->setAttribute('id','buttonsdiv');
		else if($float == 'right')
			$div->setAttribute('id','buttonsdivright');
		else
			$div->setAttribute('id','buttonsdivcenter');
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Operazioni'));
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('id','buttons');
		$table->setAttribute('class',$float);
		
		if ($float == 'left')
			$cols = 2;
		else if($float == 'right')
			$cols = 3;
		else
			$cols = 5;
		$counter = 0;
		foreach($elements as $elem)
		{	
			if($counter == 0 || $counter == $cols)
			{
				$tr = $table->appendChild(new DOMElement('tr'));
				$counter = 0;
			}
			
			$td = $tr->appendChild(new DOMElement('td'));
			$td->setAttribute('id',$elem['id']);
			$this->drawButtons($elem);
			$counter++;
		}
		
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawButtons($values)
	{
		$td = $this->getElementById($values['id']);
		
		$button = $td->appendChild(new DOMElement('a'));
		$button->setAttribute('name',$values['name']);
		$button->setAttribute('id',$values['id']);
		$button->setAttribute('value',$values['id']);
			
		if ($values['type'] == 'submit')
		{
			$button->setAttribute('onclick','document.getElementById(\'actionDB\').value = \''.$values['action'].'\';document.form.submit();');
			$button->setAttribute('href','#');
		}
		else if ($values['action'] == '')
			$button->setAttribute('href',$values['page']);
		else if ($values['GET_values'] == null)
			$button->setAttribute('href',$values['page'].'?action='.$values['action']);
		else
		{
			$getstring = '';
			foreach($values['GET_values'] as $key=>$getvalue)
					$getstring .= '&'.$key.'='.$getvalue;
			$button->setAttribute('href',$values['page'].'?action='.$values['action'].$getstring);
		}
		
		$p = $button->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($values['name']));
			
		return $button;
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawButtonsArchive($page,$container,$action=null)
	{
		$div = $this->getElementById($container);
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('id','archive');
		
		$alphabet = array('A','B','C','D','E','F','G','H',
							'I','L','M','N','O','P','Q',
							'R','S','T','U','V','Z');
		
		$tr = $table->appendChild(new DOMElement('tr'));				
		foreach($alphabet as $elem)
		{
			$td = $tr->appendChild(new DOMElement('td'));
			$a = $td->appendChild(new DOMElement('a'));
			$a->setAttribute('id',$elem);
			if ($action == null)
				$a->setAttribute('href',$page.'?action=archivio&key='.$elem);
			else
				$a->setAttribute('href',$page.'?action='.$action.'&key='.$elem);
			$p = $a->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode($elem));
		}					
		
	}	
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawList($page,$container,$values,$columns,$customs=null,$action=null,$owner=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Lista '.str_replace('.php','',strtoupper(substr($page,0,1)).substr($page,1)).$owner));
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('id','listtab');
		
		$thead = $table->appendChild(new DOMElement('thead'));
		$tr = $thead->appendChild(new DOMElement('tr'));
		foreach($columns as $value)
		{
			if(in_array($value['name'],$customs))
			{
				$td = $tr->appendChild(new DOMElement('td'));
				$p = $td->appendChild(new DOMElement('p'));
				$p->appendChild($this->htmlDom->createTextNode($value['layout']));
			}
		}
		$td = $tr->appendChild(new DOMElement('td'));
		
		$tbody = $table->appendChild(new DOMElement('tbody'));
		if($values != null)
		{
			while($rows = mysql_fetch_assoc($values))
			{
				$tr = $tbody->appendChild(new DOMElement('tr'));
				foreach($rows as $row)
				{
					$td = $tr->appendChild(new DOMElement('td'));
					$p = $td->appendChild(new DOMElement('p'));
					if(preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/',$row) and $row!=null)
					{
						$data = explode("-",$row);
						$p->appendChild($this->htmlDom->createTextNode("$data[2]/$data[1]/$data[0]"));
					}
					else
						$p->appendChild($this->htmlDom->createTextNode($row));
				}
				$td = $tr->appendChild(new DOMElement('td'));
				$a = $td->appendChild(new DOMElement('a'));
				if ($page == 'popup.php')
				{
					$a->setAttribute('href','#');
					$a->appendChild($this->htmlDom->createTextNode('Seleziona ->'));
					$a->setAttribute('onclick','window.opener.document.getElementById(\'id_'.$action.'\').value = '.$rows['ID'].';window.close();');
				}
				else
				{
					$a->setAttribute('href',$page.'?id='.$rows['ID']);
					$a->appendChild($this->htmlDom->createTextNode('Vai ai Dettagli ->'));
				}
			}
		}
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawPar($container,$text)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode($text));
		$h3->setAttribute('class','par');
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function draw()
	{
		echo $this->htmlDom->saveXML();
		
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function getElementById($id)
	{
		$xpath = new DOMXPath($this->htmlDom);
		return $xpath->query("//*[@id='$id']")->item(0);
		
	}

}

?>
