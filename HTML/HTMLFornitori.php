<?

class HTMLFornitori extends HTML
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
	function drawSelectOption($id,$options,$modify,$selected=null)
	{
		$select = $this->getElementById($id);
		
		$option = $select->appendChild(new DOMElement('option'));
		$option->setAttribute('value','seleziona');
		if($id == 'regione')
			$option->appendChild($this->htmlDom->createTextNode('Seleziona una regione...'));
		
		foreach($options as $val)
		{
			$option = $select->appendChild(new DOMElement('option'));
			if($id = 'regione')
			{
				$option->setAttribute('value',$val['cod_regione']);
				$option->appendChild($this->htmlDom->createTextNode($val['regione']));
				if($modify)
					if($selected == $val['regione'])
						$option->setAttribute('selected','selected');
			}
		}
	}

	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawFornitoriForm($container,$columns,$result=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Fornitori'));
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
		
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['cognome']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['cognome']['name']);
		$input->setAttribute('name',$columns['cognome']['name']);
		$input->setAttribute('size',$columns['cognome']['size']+3);
		$input->setAttribute('maxlength',$columns['cognome']['size']);
		if($modify)
			$input->setAttribute('value',$result['cognome']);
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['azienda']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['azienda']['name']);
		$input->setAttribute('name',$columns['azienda']['name']);
		$input->setAttribute('size','40');
		$input->setAttribute('maxlength',$columns['azienda']['size']);
		if($modify)
			$input->setAttribute('value',$result['azienda']);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['codice_fiscale']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['codice_fiscale']['name']);
		$input->setAttribute('name',$columns['codice_fiscale']['name']);
		$input->setAttribute('size',$columns['codice_fiscale']['size']+3);
		$input->setAttribute('maxlength',$columns['codice_fiscale']['size']);
		if($modify)
			$input->setAttribute('value',$result['codice_fiscale']);
		
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['partita_iva']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['partita_iva']['name']);
		$input->setAttribute('name',$columns['partita_iva']['name']);
		$input->setAttribute('size',$columns['partita_iva']['size']+3);
		$input->setAttribute('maxlength',$columns['partita_iva']['size']);
		if($modify)
			$input->setAttribute('value',$result['partita_iva']);

		$tr = $table->appendChild(new DOMElement('tr'));		
		$td = $tr->appendChild(new DOMElement('td'));
		$br = $td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['indirizzo']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['indirizzo']['name']);
		$input->setAttribute('name',$columns['indirizzo']['name']);
		$input->setAttribute('size','40');
		$input->setAttribute('maxlength',$columns['indirizzo']['size']);
		if($modify)
			$input->setAttribute('value',$result['indirizzo']);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['regione']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('name',$columns['regione']['name']);
		$select->setAttribute('id',$columns['regione']['name']);
		
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['provincia']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('name',$columns['provincia']['name']);
		$select->setAttribute('id',$columns['provincia']['name']);
		if($modify)
		{
			$option = $select->appendChild(new DOMElement('option'));
			$option->setAttribute('value',$result['provincia']);
			$option->appendChild($this->htmlDom->createTextNode($result['provincia']));
		}
		
		$tr = $table->appendChild(new DOMElement('tr'));		
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['comune']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('name',$columns['comune']['name']);
		$select->setAttribute('id',$columns['comune']['name']);
		if($modify)
		{
			$option = $select->appendChild(new DOMElement('option'));
			$option->setAttribute('value',$result['comune']);
			$option->appendChild($this->htmlDom->createTextNode($result['comune']));
		}
		
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['cap']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['cap']['name']);
		$input->setAttribute('name',$columns['cap']['name']);
		$input->setAttribute('size',$columns['cap']['size']+3);
		$input->setAttribute('maxlength',$columns['cap']['size']);
		if($modify)
			$input->setAttribute('value',$result['cap']);
		
		$tr = $table->appendChild(new DOMElement('tr'));		
		$td = $tr->appendChild(new DOMElement('td'));
		$br = $td->appendChild(new DOMElement('br'));	
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['mail']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['mail']['name']);
		$input->setAttribute('name',$columns['mail']['name']);
		$input->setAttribute('size','40');
		$input->setAttribute('maxlength',$columns['mail']['size']);
		if($modify)
			$input->setAttribute('value',$result['mail']);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['telefono_1']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['telefono_1']['name']);
		$input->setAttribute('name',$columns['telefono_1']['name']);
		$input->setAttribute('size',$columns['telefono_1']['size']+3);
		$input->setAttribute('maxlength',$columns['telefono_1']['size']);
		if($modify)
			$input->setAttribute('value',$result['telefono_1']);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['telefono_2']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['telefono_2']['name']);
		$input->setAttribute('name',$columns['telefono_2']['name']);
		$input->setAttribute('size',$columns['telefono_2']['size']+3);
		$input->setAttribute('maxlength',$columns['telefono_2']['size']);
		if($modify)
			$input->setAttribute('value',$result['telefono_2']);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['fax']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['fax']['name']);
		$input->setAttribute('name',$columns['fax']['name']);
		$input->setAttribute('size',$columns['fax']['size']+3);
		$input->setAttribute('maxlength',$columns['fax']['size']);
		if($modify)
			$input->setAttribute('value',$result['fax']);
		
		$tr = $table->appendChild(new DOMElement('tr'));		
		$td = $tr->appendChild(new DOMElement('td'));
		$br = $td->appendChild(new DOMElement('br'));	
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['data_di_registrazione']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','datepicker');
		$input->setAttribute('name',$columns['data_di_registrazione']['name']);
		$input->setAttribute('size','11');
		$input->setAttribute('maxlength','10');
		if($modify)
			$input->setAttribute('value',$result['data_di_registrazione']);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','hidden');
		$input->setAttribute('id','actionDB');
		$input->setAttribute('name','actionDB');
	}

}

?>
