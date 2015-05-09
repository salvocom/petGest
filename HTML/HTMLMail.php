<?

class HTMLMail extends HTML
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
	function drawMailForm($container,$columns,$result=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Mail'));
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
		$p->appendChild($this->htmlDom->createTextNode($columns['oggetto']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['oggetto']['name']);
		$input->setAttribute('name',$columns['oggetto']['name']);
		$input->setAttribute('size',80);
		$input->setAttribute('maxlength',$columns['oggetto']['size']);
		if($modify)
			$input->setAttribute('value',$result['oggetto']);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode($columns['testo']['layout']));
		$td = $tr->appendChild(new DOMElement('td'));
		$textarea = $td->appendChild(new DOMElement('textarea'));
		$textarea->setAttribute('id',$columns['testo']['name']);
		$textarea->setAttribute('name',$columns['testo']['name']);
		$textarea->setAttribute('class','textareamail');
		if($modify)
			$textarea->appendChild($this->htmlDom->createTextNode($result['testo']));
			
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','hidden');
		$input->setAttribute('id','actionDB');
		$input->setAttribute('name','actionDB');
	}

}

?>
