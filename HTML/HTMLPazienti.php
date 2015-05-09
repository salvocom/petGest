<?

class HTMLPazienti extends HTML
{
	
	function __construct() 
	{
		parent::__construct();		
	}

	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawPazientiForm($container,$columns,$result=null,$cliente=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Pazienti'));
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('id','formtab');
		
		$modify = !is_null($result);
		
		if($modify)
		{
			$tr = $table->appendChild(new DOMElement('tr'));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','hidden');
			$input->setAttribute('id',$columns['ID']['name']);
			$input->setAttribute('name',$columns['ID']['name']);
			$input->setAttribute('value',$result['ID']);
		}
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['nome']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['nome']['name']);
		$input->setAttribute('name',$columns['nome']['name']);
		$input->setAttribute('size',$columns['nome']['size']+3);
		$input->setAttribute('maxlength',$columns['nome']['size']);
		if($modify)
			$input->setAttribute('value',$result['nome']);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['microchip']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['microchip']['name']);
		$input->setAttribute('name',$columns['microchip']['name']);
		$input->setAttribute('size',$columns['microchip']['size']+3);
		$input->setAttribute('maxlength',$columns['microchip']['size']);
		if($modify)
			$input->setAttribute('value',$result['microchip']);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','hidden');
		$input->setAttribute('id',$columns['id_cliente']['name']);
		$input->setAttribute('name',$columns['id_cliente']['name']);
		
		if($modify || $cliente != null)
			$input->setAttribute('value',$result['id_cliente']);
		if($cliente != null)
			$input->setAttribute('value',$cliente);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['specie']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('name',$columns['specie']['name']);
		$select->setAttribute('id',$columns['specie']['name']);
		
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['razza']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('name',$columns['razza']['name']);
		$select->setAttribute('id',$columns['razza']['name']);
		if($modify)
		{
			$option = $select->appendChild(new DOMElement('option'));
			$option->setAttribute('value',$result['razza']);
			$option->appendChild($this->htmlDom->createTextNode($result['razza']));
		}
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['sesso']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('name',$columns['sesso']['name']);
		$select->setAttribute('id',$columns['sesso']['name']);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['taglia']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('name',$columns['taglia']['name']);
		$select->setAttribute('id',$columns['taglia']['name']);
		
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['pelo']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('name',$columns['pelo']['name']);
		$select->setAttribute('id',$columns['pelo']['name']);
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['peso']['layout']." (Kg)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['peso']['name']);
		$input->setAttribute('name',$columns['peso']['name']);
		$input->setAttribute('size',$columns['peso']['size']+8);
		$input->setAttribute('maxlength',$columns['peso']['size']+8);
		if($modify)
			$input->setAttribute('value',$result['peso']);
		
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['colore']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['colore']['name']);
		$input->setAttribute('name',$columns['colore']['name']);
		$input->setAttribute('size',$columns['colore']['size']+3);
		$input->setAttribute('maxlength',$columns['colore']['size']);
		if($modify)
			$input->setAttribute('value',$result['colore']);
		
		$tr = $table->appendChild(new DOMElement('tr'));		
		$td = $tr->appendChild(new DOMElement('td'));
		$br = $td->appendChild(new DOMElement('br'));

		$tr = $table->appendChild(new DOMElement('tr'));				
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p->appendChild($this->htmlDom->createTextNode($columns['segni_particolari']['layout']));
		$textarea = $td->appendChild(new DOMElement('textarea'));
		$textarea->setAttribute('id',$columns['segni_particolari']['name']);
		$textarea->setAttribute('name',$columns['segni_particolari']['name']);
		if($modify)
			$textarea->appendChild($this->htmlDom->createTextNode($result['segni_particolari']));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['data_di_nascita']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','datanascita');
		$input->setAttribute('name',$columns['data_di_nascita']['name']);
		$input->setAttribute('size','11');
		$input->setAttribute('maxlength','10');
		if($modify and $result['data_di_nascita']!=null)
		{
			$data = explode('-',$result['data_di_nascita']);
			$input->setAttribute('value',"$data[2]/$data[1]/$data[0]");
		}
			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['data_decesso']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','datadecesso');
		$input->setAttribute('name',$columns['data_decesso']['name']);
		$input->setAttribute('size','11');
		$input->setAttribute('maxlength','10');
		if($modify and $result['data_decesso']!=null)
		{
			$data = explode('-',$result['data_decesso']);
			$input->setAttribute('value',"$data[2]/$data[1]/$data[0]");
		}
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['data_di_registrazione']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['data_di_registrazione']['name']);
		$input->setAttribute('name',$columns['data_di_registrazione']['name']);
		$input->setAttribute('size','11');
		$input->setAttribute('maxlength','10');
		$input->setAttribute('readonly','readonly');
		if($modify and $result['data_di_registrazione']!=null)
		{
			$data = explode('-',$result['data_di_registrazione']);
			$input->setAttribute('value',"$data[2]/$data[1]/$data[0]");
		}
		else
			$input->setAttribute('value',date("d/m/Y"));
		
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
	function drawPazientiOption($id,$options,$modify,$selected=null)
	{
		$select = $this->getElementById($id);
		
		$option = $select->appendChild(new DOMElement('option'));
		$option->setAttribute('value','seleziona');
		
		if($id == 'specie')
			$option->appendChild($this->htmlDom->createTextNode('Seleziona una specie...'));
		if($id == 'sesso')
			$option->appendChild($this->htmlDom->createTextNode('Seleziona il sesso...'));
		if($id == 'taglia')
			$option->appendChild($this->htmlDom->createTextNode(''));
		if($id == 'pelo')
			$option->appendChild($this->htmlDom->createTextNode(''));
		
		foreach($options as $key=>$val)
		{
			$option = $select->appendChild(new DOMElement('option'));
			if($id == 'specie')
				$option->setAttribute('value',$key);
			else
				$option->setAttribute('value',$val);
			$option->appendChild($this->htmlDom->createTextNode($val));
			if($modify)
				if($selected == $val)
					$option->setAttribute('selected','selected');
		}
	}

	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawListPazienti($page,$container,$values,$columns,$action=null,$owner=null)
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
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode($value));
		}
		$td = $tr->appendChild(new DOMElement('td'));
		
		$tbody = $table->appendChild(new DOMElement('tbody'));
		if($values != null)
		{
			foreach($values as $value)
			{
				$tr = $tbody->appendChild(new DOMElement('tr'));
				
				$td = $tr->appendChild(new DOMElement('td'));
				$p = $td->appendChild(new DOMElement('p'));
				$p->appendChild($this->htmlDom->createTextNode($value['ID']));
				
				$td = $tr->appendChild(new DOMElement('td'));
				$p = $td->appendChild(new DOMElement('p'));
				$p->appendChild($this->htmlDom->createTextNode($value['nome']));
				
				$td = $tr->appendChild(new DOMElement('td'));
				$p = $td->appendChild(new DOMElement('p'));
				$p->appendChild($this->htmlDom->createTextNode($value['microchip']));

				$td = $tr->appendChild(new DOMElement('td'));
				$p = $td->appendChild(new DOMElement('p'));
				$p->appendChild($this->htmlDom->createTextNode($value['specie']));
				
				$td = $tr->appendChild(new DOMElement('td'));
				$p = $td->appendChild(new DOMElement('p'));
				$p->appendChild($this->htmlDom->createTextNode($value['razza']));
				
				$td = $tr->appendChild(new DOMElement('td'));
				$p = $td->appendChild(new DOMElement('p'));
				$p->appendChild($this->htmlDom->createTextNode($value['sesso']));
								
				$td = $tr->appendChild(new DOMElement('td'));
				$p = $td->appendChild(new DOMElement('p'));
				if(!is_null($value['data_di_nascita']))
				{
					$data = explode("-",$value['data_di_nascita']);
					$p->appendChild($this->htmlDom->createTextNode("$data[2]/$data[1]/$data[0]"));
				}
				
				$td = $tr->appendChild(new DOMElement('td'));
				$a = $td->appendChild(new DOMElement('a'));
				$a->setAttribute('href',$page.'?id='.$value['ID']);
				$a->appendChild($this->htmlDom->createTextNode('Vai ai Dettagli ->'));
			}
		}
	}
	
}

?>
