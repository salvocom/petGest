<?

class HTMLEsamiEmocromo extends HTML
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
	function drawEsameEmocromo($container,$columns,$paziente,$result=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Emocromo'));
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
		$p->appendChild($this->htmlDom->createTextNode("ESAME EMOCROMO"));
		$td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("RBC (mln)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['RBC']);
		$input->setAttribute('name',$columns['RBC']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');
		if($modify)
			$input->setAttribute('value',$result['RBC']);
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Hb (g/dl)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['Hb']);
		$input->setAttribute('name',$columns['Hb']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');
		if($modify)
			$input->setAttribute('value',$result['Hb']);

		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Hct (%)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['Hct']);
		$input->setAttribute('name',$columns['Hct']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');
		if($modify)
			$input->setAttribute('value',$result['Hct']);
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("MCV (fl)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['MCV']);
		$input->setAttribute('name',$columns['MCV']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');
		if($modify)
			$input->setAttribute('value',$result['MCV']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("MCH (pg)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['MCH']);
		$input->setAttribute('name',$columns['MCH']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');
		if($modify)
			$input->setAttribute('value',$result['MCH']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("MCHC (g/dl)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['MCHC']);
		$input->setAttribute('name',$columns['MCHC']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');
		if($modify)
			$input->setAttribute('value',$result['MCHC']);
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("RDW (%)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['RDW']);
		$input->setAttribute('name',$columns['RDW']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');
		if($modify)
			$input->setAttribute('value',$result['RDW']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("WBC (x 1000)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['WBC']);
		$input->setAttribute('name',$columns['WBC']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');	
		if($modify)
			$input->setAttribute('value',$result['WBC']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("LYM (%)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['LYM_per']);
		$input->setAttribute('name',$columns['LYM_per']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');	
		if($modify)
			$input->setAttribute('value',$result['LYM_per']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("MON (%)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['MON_per']);
		$input->setAttribute('name',$columns['MON_per']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');	
		if($modify)
			$input->setAttribute('value',$result['MON_per']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("GRA (%)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['GRA_per']);
		$input->setAttribute('name',$columns['GRA_per']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');	
		if($modify)
			$input->setAttribute('value',$result['GRA_per']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("LYM (mln)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['LYM']);
		$input->setAttribute('name',$columns['LYM']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');	
		if($modify)
			$input->setAttribute('value',$result['LYM']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("MON (mln)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['MON']);
		$input->setAttribute('name',$columns['MON']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');	
		if($modify)
			$input->setAttribute('value',$result['MON']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("GRA (mln)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['GRA']);
		$input->setAttribute('name',$columns['GRA']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');	
		if($modify)
			$input->setAttribute('value',$result['GRA']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("PLT (x 1000)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['PLT']);
		$input->setAttribute('name',$columns['PLT']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');	
		if($modify)
			$input->setAttribute('value',$result['PLT']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("MPV (fl)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['MPV']);
		$input->setAttribute('name',$columns['MPV']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','10');	
		if($modify)
			$input->setAttribute('value',$result['MPV']);
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Note"));
		$td = $tr->appendChild(new DOMElement('td'));
		$textarea = $td->appendChild(new DOMElement('textarea'));
		$textarea->setAttribute('id',$columns['note']);
		$textarea->setAttribute('name',$columns['note']);	
		if($modify)
			$textarea->appendChild($this->htmlDom->createTextNode($result['note']));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','hidden');
		$input->setAttribute('id','actionDB');
		$input->setAttribute('name','actionDB');
	}

}

?>
