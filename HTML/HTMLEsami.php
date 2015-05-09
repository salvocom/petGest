<?

class HTMLEsami extends HTML
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
	function drawListEsami($container,$values,$columns,$action=null,$owner=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Lista Esami'.$owner));
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
				$data = explode("-",$value['data']);
				$p->appendChild($this->htmlDom->createTextNode("$data[2]/$data[1]/$data[0]"));
				
				$td = $tr->appendChild(new DOMElement('td'));
				$p = $td->appendChild(new DOMElement('p'));
				$p->appendChild($this->htmlDom->createTextNode($value['tipo']));
				
				$td = $tr->appendChild(new DOMElement('td'));
				$a = $td->appendChild(new DOMElement('a'));
				if($value['tipo'] == 'Esame Clinico')
					$page = 'esamiclinici.php';
				if($value['tipo'] == 'Esame Urine')
					$page = 'esamiurine.php';
				$a->setAttribute('href',$page.'?id='.$value['ID']);
				$a->appendChild($this->htmlDom->createTextNode('Vai ai Dettagli ->'));
			}
		}
	}

}

?>
