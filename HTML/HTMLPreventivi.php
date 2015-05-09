<?

class HTMLPreventivi extends HTML
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
	function drawHeaderAmbulatorio($container,$ambulatorio,$owner=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Preventivi'.$owner));
		
		$div2 = $div->appendChild(new DOMElement('div'));
		$div2->setAttribute('id','tablediv');
		$table = $div2->appendChild(new DOMElement('table'));
		$table->setAttribute('class','headtabfirst');
		
		$tr = $table->appendChild(new DOMElement('tr'));				
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Ambulatorio Veterinario Ibleo"));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("della D.ssa $ambulatorio[nome] $ambulatorio[cognome]"));
		$br = $td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("$ambulatorio[indirizzo]"));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("$ambulatorio[cap], $ambulatorio[citta]($ambulatorio[provincia])"));
		$br = $td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode(" P. IVA: "));
		$p->appendChild($this->htmlDom->createTextNode("$ambulatorio[partita_iva]"));
		$br = $td->appendChild(new DOMElement('br'));

		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode(" E-Mail: "));
		$p->appendChild($this->htmlDom->createTextNode("$ambulatorio[mail]"));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode(" Telefono: "));
		$p->appendChild($this->htmlDom->createTextNode("$ambulatorio[telefono]"));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode(" Cellulare: "));
		$p->appendChild($this->htmlDom->createTextNode("$ambulatorio[cellulare]"));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','hidden');
		$input->setAttribute('id','id_ambulatorio');
		$input->setAttribute('name','id_ambulatorio');
		$input->setAttribute('value','1');
	}

	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawHeaderCliente($container,$cliente)
	{
		$div = $this->getElementById($container);
		
		$div2 = $div->appendChild(new DOMElement('div'));
		$div2->setAttribute('id','tablediv');
		$table = $div2->appendChild(new DOMElement('table'));
		$table->setAttribute('class','headtab');
		
		$tr = $table->appendChild(new DOMElement('tr'));				
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Cliente:"));
		$br = $td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));				
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("$cliente[nome] $cliente[cognome]"));
		$br = $td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("$cliente[indirizzo]"));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("$cliente[cap], $cliente[comune]($cliente[provincia])"));
		$br = $td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode(" Codice Fiscale: "));
		$p->appendChild($this->htmlDom->createTextNode("$cliente[codice_fiscale]"));
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode(" P. IVA: "));
		$p->appendChild($this->htmlDom->createTextNode("$cliente[partita_iva]"));
		$br = $td->appendChild(new DOMElement('br'));
		$br = $td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','hidden');
		$input->setAttribute('id','id_cliente');
		$input->setAttribute('name','id_cliente');
		$input->setAttribute('value',$cliente['ID']);
		
	}

	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawPreventiviForm($container,$columns,$result=null)
	{
		$div = $this->getElementById($container);
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('class','fatturetab');
		
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
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Totale Preventivo"));
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['totale_preventivo']);
		$input->setAttribute('name',$columns['totale_preventivo']);
		$input->setAttribute('size','14');
		$input->setAttribute('readonly','readonly');
		if($modify)
			$input->setAttribute('value',$result['totale_preventivo']);
		else
			$input->setAttribute('value','0.00');
		$br = $td->appendChild(new DOMElement('br'));
			
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
	function drawPrestazioniPreventivi($container,$istanzecol,$prestazioni=null,$data=null)
	{
		$div = $this->getElementById($container);
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('class','selecttab');
		
		$thead = $table->appendChild(new DOMElement('thead'));
		
		$tr = $thead->appendChild(new DOMElement('tr'));
		$th = $tr->appendChild(new DOMElement('th'));
		$p = $th->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode('Data Preventivo: '));
		$input = $p->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','datepicker');
		$input->setAttribute('name','data');
		$input->setAttribute('size',9);
		if($data==null)
			$input->setAttribute('value',date("d/m/Y"));
		else
		{
			$data = explode('-',$data);
			$input->setAttribute('value',"$data[2]/$data[1]/$data[0]");
		}
		
		$tr = $thead->appendChild(new DOMElement('tr'));
		
		$th = $tr->appendChild(new DOMElement('th'));
		$p = $th->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode('Descrizione'));
		$th = $tr->appendChild(new DOMElement('th'));
		$p = $th->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode('Quantità'));
		$th = $tr->appendChild(new DOMElement('th'));
		$p = $th->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode('Costo'));
		
		$ids = array('1','2','3','4','5','6','7','8','9','10');
		foreach($ids as $val)
		{
			$modify = false;
			if($prestazioni != null and array_key_exists($val,$prestazioni))
				$modify = true;
			
			$tr = $table->appendChild(new DOMElement('tr'));
			
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$istanzecol['descrizione'].$val);
			$input->setAttribute('name',$istanzecol['descrizione'].$val);
			$input->setAttribute('size',35);
			if($modify)
			{
				$input->setAttribute('value',$prestazioni[$val]['descrizione']);
				$input->setAttribute('readonly','readonly');
			}
			
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$istanzecol['quantita'].$val);
			$input->setAttribute('name',$istanzecol['quantita'].$val);
			$input->setAttribute('size',7);
			$input->setAttribute('onchange',"calcolaPreventivo()");
			if($modify)
			{
				$input->setAttribute('value',$prestazioni[$val]['quantita']);
				$input->setAttribute('readonly','readonly');
			}
			
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('id',$istanzecol['costo'].$val);
			$input->setAttribute('name',$istanzecol['costo'].$val);
			$input->setAttribute('type','text');
			$input->setAttribute('size','6');
			$input->setAttribute('maxlength','6');
			$input->setAttribute('onchange',"calcolaPreventivo()");
			if($modify)
			{
				$input->setAttribute('value',$prestazioni[$val]['costo']);
				$input->setAttribute('readonly','readonly');
			}
			
			if($modify)
			{
				$tr = $table->appendChild(new DOMElement('tr'));
					
				$td = $tr->appendChild(new DOMElement('td'));
				$input = $td->appendChild(new DOMElement('input'));
				$input->setAttribute('type','hidden');
				$input->setAttribute('id','ID'.$val);
				$input->setAttribute('name','ID'.$val);
				$input->setAttribute('value',$prestazioni[$val]['ID']);
			}

		}
	}
	
}
?>
