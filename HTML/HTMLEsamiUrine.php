<?

class HTMLEsamiUrine extends HTML
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
	function drawEsameUrine($container,$columns,$paziente,$result=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Esame delle Urine'));
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('class','esamitab');
		
		$modify = !is_null($result);
		
		if($modify)
		{
			$tr = $table->appendChild(new DOMElement('tr'));
				
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','hidden');
			$input->setAttribute('id','ID');
			$input->setAttribute('name','ID');
			$input->setAttribute('value',$result['ID']);
		}
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','hidden');
		$input->setAttribute('id','id_paziente');
		$input->setAttribute('name','id_paziente');
		$input->setAttribute('value',$paziente['ID']);
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$td->setAttribute('colspan','2');
		$td->setAttribute('class','theader');
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->setAttribute('class','first');
		$b->appendChild($this->htmlDom->createTextNode("Nome Paziente: "));
		$p->appendChild($this->htmlDom->createTextNode("$paziente[nome] "));

		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Id Microchip: "));
		$p->appendChild($this->htmlDom->createTextNode("$paziente[microchip] "));

		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Razza: "));
		$p->appendChild($this->htmlDom->createTextNode("$paziente[razza]"));
		$td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$td->setAttribute('colspan','2');
		$span = $td->appendChild(new DOMElement('span'));
		$p = $span->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Data"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','datepicker');
		$input->setAttribute('name',$columns['data']);
		$input->setAttribute('size','11');
		$input->setAttribute('maxlength','10');
		if($modify and $result['data']!=null)
		{
			$data = explode('-',$result['data']);
			$input->setAttribute('value',"$data[2]/$data[1]/$data[0]");
		}
		else
			$input->setAttribute('value',date("d/m/Y"));
		
		$tr = $table->appendChild(new DOMElement('tr'));		
		$td = $tr->appendChild(new DOMElement('td'));
		$td->appendChild(new DOMElement('br'));
		$td->setAttribute('colspan','2');
		$p = $td->appendChild(new DOMElement('p'));
		$p->setAttribute('class','title');
		$p->appendChild($this->htmlDom->createTextNode("ESAME URINE"));
		$td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Tecnica di Raccolta"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['tecnica_raccolta']);
		$input->setAttribute('name',$columns['tecnica_raccolta']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['tecnica_raccolta']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','tecnica_raccolta_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Cellule Epiteliali"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['cellule_epiteliali']);
		$input->setAttribute('name',$columns['cellule_epiteliali']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['cellule_epiteliali']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','cellule_epiteliali_options');
		$select->setAttribute('onclick',"setEsame(this.id)");

		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Tipi di Cellule Epiteliali"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['tipi_cellule_epiteliali']);
		$input->setAttribute('name',$columns['tipi_cellule_epiteliali']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['tipi_cellule_epiteliali']);
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Batteri"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['batteri']);
		$input->setAttribute('name',$columns['batteri']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['batteri']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','batteri_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Forma Batterica"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['forma_batterica']);
		$input->setAttribute('name',$columns['forma_batterica']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['forma_batterica']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Cristalli"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['cristalli']);
		$input->setAttribute('name',$columns['cristalli']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['cristalli']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','cristalli_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Tipo di Cristalli"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['tipo_cristalli']);
		$input->setAttribute('name',$columns['tipo_cristalli']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['tipo_cristalli']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Peso Specifico"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['peso_specifico']);
		$input->setAttribute('name',$columns['peso_specifico']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','8');	
		if($modify)
			$input->setAttribute('value',$result['peso_specifico']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("pH"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['ph']);
		$input->setAttribute('name',$columns['ph']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','8');	
		if($modify)
			$input->setAttribute('value',$result['ph']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Leucociti (mg/dl)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['leucociti']);
		$input->setAttribute('name',$columns['leucociti']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','8');	
		if($modify)
			$input->setAttribute('value',$result['leucociti']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Nitriti (mg/dl)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['nitriti']);
		$input->setAttribute('name',$columns['nitriti']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','8');	
		if($modify)
			$input->setAttribute('value',$result['nitriti']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Urobilina (mg/dl)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['urobilina']);
		$input->setAttribute('name',$columns['urobilina']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','8');	
		if($modify)
			$input->setAttribute('value',$result['urobilina']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Proteine (mg/dl)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['proteine']);
		$input->setAttribute('name',$columns['proteine']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','8');	
		if($modify)
			$input->setAttribute('value',$result['proteine']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Sangue"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['sangue']);
		$input->setAttribute('name',$columns['sangue']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','8');	
		if($modify)
			$input->setAttribute('value',$result['sangue']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Chetoni (mg/dl)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['chetoni']);
		$input->setAttribute('name',$columns['chetoni']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','8');	
		if($modify)
			$input->setAttribute('value',$result['chetoni']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Bilirubina (mg/dl)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['bilirubina']);
		$input->setAttribute('name',$columns['bilirubina']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','8');	
		if($modify)
			$input->setAttribute('value',$result['bilirubina']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Glucosio (mg/dl)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['glucosio']);
		$input->setAttribute('name',$columns['glucosio']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','8');	
		if($modify)
			$input->setAttribute('value',$result['glucosio']);
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Problemi"));
		$td = $tr->appendChild(new DOMElement('td'));
		$textarea = $td->appendChild(new DOMElement('textarea'));
		$textarea->setAttribute('id',$columns['problemi']);
		$textarea->setAttribute('name',$columns['problemi']);	
		if($modify)
			$textarea->appendChild($this->htmlDom->createTextNode($result['problemi']));
		
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
	function drawEsamiOption($id,$options,$modify,$selected=null)
	{
		$select = $this->getElementById($id);
		
		$option = $select->appendChild(new DOMElement('option'));
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

}

?>
