<?

class HTMLFatture extends HTML
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
	function drawFattureAmbulatorio($container,$ambulatorio,$owner=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Fatture'.$owner));
		
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
	function drawFattureCliente($container,$cliente,$modify)
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
		
		if($modify)
		{	
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
		}
		else
		{
			$tr = $table->appendChild(new DOMElement('tr'));				
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Nome: "));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('value',$cliente['nome']);
			$input->setAttribute('id','nome');
			$input->setAttribute('name','nome');
			$input->setAttribute('size',20);
			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Cognome: "));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('value',$cliente['cognome']);
			$input->setAttribute('id','cognome');
			$input->setAttribute('name','cognome');
			$input->setAttribute('size',20);
			
			$tr = $table->appendChild(new DOMElement('tr'));				
			$td = $tr->appendChild(new DOMElement('td'));
			$td->setAttribute('colspan',2);
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Indirizzo: "));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('value',$cliente['indirizzo']);
			$input->setAttribute('id','indirizzo');
			$input->setAttribute('name','indirizzo');
			$input->setAttribute('size',40);
			
			$tr = $table->appendChild(new DOMElement('tr'));				
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Cap: "));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('value',$cliente['cap']);
			$input->setAttribute('id','cap');
			$input->setAttribute('name','cap');
			$input->setAttribute('size',5);
			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Comune: "));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('value',$cliente['comune']);
			$input->setAttribute('id','comune');
			$input->setAttribute('name','comune');
			$input->setAttribute('size',20);
			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Provincia: "));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('value',$cliente['provincia']);
			$input->setAttribute('id','provincia');
			$input->setAttribute('name','provincia');
			$input->setAttribute('size',2);
			
			$tr = $table->appendChild(new DOMElement('tr'));				
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Codice Fiscale: "));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('value',$cliente['codice_fiscale']);
			$input->setAttribute('id','codice_fiscale');
			$input->setAttribute('name','codice_fiscale');
			$input->setAttribute('size',20);
			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Partita IVA: "));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('value',$cliente['partita_iva']);
			$input->setAttribute('id','partita_iva');
			$input->setAttribute('name','partita_iva');
			$input->setAttribute('size',20);
		}
		
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
	function drawFatturePazienti($container,$pazienti,$paziente=null)
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
		$b->appendChild($this->htmlDom->createTextNode("Paziente:"));
		$br = $td->appendChild(new DOMElement('br'));
		
		$modify = false;
		if($paziente!=null)
			$modify = true;
		
		if($modify)
		{			
			$tr = $table->appendChild(new DOMElement('tr'));				
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Nome Pazisnte: "));
			$p->appendChild($this->htmlDom->createTextNode("$paziente[nome]"));
			$br = $td->appendChild(new DOMElement('br'));
			
			$tr = $table->appendChild(new DOMElement('tr'));				
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Id Microchip: "));
			$p->appendChild($this->htmlDom->createTextNode("$paziente[microchip]"));
			$br = $td->appendChild(new DOMElement('br'));
			
			$tr = $table->appendChild(new DOMElement('tr'));				
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Razza: "));
			$p->appendChild($this->htmlDom->createTextNode("$paziente[razza]"));
			$br = $td->appendChild(new DOMElement('br'));
		}
		else
		{
			$tr = $table->appendChild(new DOMElement('tr'));
			$td = $tr->appendChild(new DOMElement('td'));
			$select = $td->appendChild(new DOMElement('select'));
			$option = $select->appendChild(new DOMElement('option'));
			$option->setAttribute('value','');
			$option->appendChild($this->htmlDom->createTextNode('Seleziona un Paziente...'));
			$option->setAttribute('onclick',"getPaziente(null,null,null,null)");
			
			if($pazienti != null)
			{
				foreach($pazienti as $val)
				{	
					$option = $select->appendChild(new DOMElement('option'));
					$option->setAttribute('value','');
					$option->setAttribute('onclick',"getPaziente('$val[nome]','$val[microchip]','$val[razza]','$val[ID]')");
					$option->appendChild($this->htmlDom->createTextNode($val['nome']));
				}
			}
			$br = $td->appendChild(new DOMElement('br'));

			$tr = $table->appendChild(new DOMElement('tr'));				
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Nome Paziente: "));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id','nome_paziente');
			$input->setAttribute('size',20);
			
			$tr = $table->appendChild(new DOMElement('tr'));				
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("ID Microchip: "));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id','microchip_paziente');
			$input->setAttribute('size',20);
			
			$tr = $table->appendChild(new DOMElement('tr'));				
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$b = $p->appendChild(new DOMElement('b'));
			$b->appendChild($this->htmlDom->createTextNode("Razza: "));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id','razza_paziente');
			$input->setAttribute('size',20);
		}
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','hidden');
		$input->setAttribute('id','id_paziente');
		$input->setAttribute('name','id_paziente');
		if($modify)
			$input->setAttribute('value',$paziente['ID']);
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawPrestazioniFatture($container,$istanzecol,$stato=false,$prestazioni=null,$data=null)
	{
		$div = $this->getElementById($container);
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('class','selecttab');
		
		$thead = $table->appendChild(new DOMElement('thead'));
		
		$tr = $thead->appendChild(new DOMElement('tr'));
		$th = $tr->appendChild(new DOMElement('th'));
		$p = $th->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode('Data Fattura: '));
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
		$th = $tr->appendChild(new DOMElement('th'));
		$p = $th->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode('Enpav'));
		$th = $tr->appendChild(new DOMElement('th'));
		$p = $th->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode('IVA'));
		$th = $tr->appendChild(new DOMElement('th'));
		$p = $th->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode('Tipo Operazione'));
		$th = $tr->appendChild(new DOMElement('th'));
		$p = $th->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode('Norma Esenzione'));
		
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
			$input->setAttribute('onchange',"setPrestazione($val)");
			if($modify)
				$input->setAttribute('value',$prestazioni[$val]['descrizione']);
			if($stato)
				$input->setAttribute('readonly','readonly');
			
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$istanzecol['quantita'].$val);
			$input->setAttribute('name',$istanzecol['quantita'].$val);
			$input->setAttribute('size',7);
			$input->setAttribute('onchange',"calcolaFattura()");
			if($stato)
				$input->setAttribute('readonly','readonly');
			if($modify)
				$input->setAttribute('value',$prestazioni[$val]['quantita']);
			else
				$input->setAttribute('disabled','disabled');
			
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('id',$istanzecol['costo'].$val);
			$input->setAttribute('name',$istanzecol['costo'].$val);
			$input->setAttribute('type','text');
			$input->setAttribute('size','6');
			$input->setAttribute('maxlength','6');
			$input->setAttribute('onchange',"calcolaFattura()");
			if($stato)
				$input->setAttribute('readonly','readonly');
			if($modify)
				$input->setAttribute('value',$prestazioni[$val]['costo']);
			else
				$input->setAttribute('disabled','disabled');
			
			$td = $tr->appendChild(new DOMElement('td'));
			if($stato and $modify)
			{
				$input = $td->appendChild(new DOMElement('input'));
				$input->setAttribute('id',$istanzecol['enpav'].$val);
				$input->setAttribute('name',$istanzecol['enpav'].$val);
				$input->setAttribute('value',$prestazioni[$val]['enpav']);
				$input->setAttribute('type','text');
				$input->setAttribute('size','3');
				$input->setAttribute('readonly','readonly');
			}
			else
			{
				$select = $td->appendChild(new DOMElement('select'));
				$select->setAttribute('id',$istanzecol['enpav'].$val);
				$select->setAttribute('name',$istanzecol['enpav'].$val);
				$select->setAttribute('onclick',"calcolaFattura()");
				$option = $select->appendChild(new DOMElement('option'));
				$option->setAttribute('value','');
				$option->appendChild($this->htmlDom->createTextNode(''));
				$values = array(2,5);
				foreach($values as $value)
				{
					$option = $select->appendChild(new DOMElement('option'));
					$option->setAttribute('value',$value);
					$option->appendChild($this->htmlDom->createTextNode($value));
					if($modify)
						if($value == $prestazioni[$val]['enpav'])
							$option->setAttribute('selected','selected');
				}
				if(!$modify)
					$select->setAttribute('disabled','disabled');
			}
			
			$td = $tr->appendChild(new DOMElement('td'));
			if($stato and $modify)
			{
				$input = $td->appendChild(new DOMElement('input'));
				$input->setAttribute('id',$istanzecol['IVA'].$val);
				$input->setAttribute('name',$istanzecol['IVA'].$val);
				$input->setAttribute('value',$prestazioni[$val]['IVA']);
				$input->setAttribute('type','text');
				$input->setAttribute('size','4');
				$input->setAttribute('readonly','readonly');
			}
			else
			{
				$select = $td->appendChild(new DOMElement('select'));
				$select->setAttribute('id',$istanzecol['IVA'].$val);
				$select->setAttribute('name',$istanzecol['IVA'].$val);
				$select->setAttribute('onclick',"calcolaFattura()");
				$option = $select->appendChild(new DOMElement('option'));
				$option->setAttribute('value','');
				$values = array(10,22);
				foreach($values as $value)
				{
					$option = $select->appendChild(new DOMElement('option'));
					$option->setAttribute('value',$value);
					$option->appendChild($this->htmlDom->createTextNode($value));
					if($modify)
						if($value == $prestazioni[$val]['IVA'])
							$option->setAttribute('selected','selected');
				}
				if(!$modify)
					$select->setAttribute('disabled','disabled');
			}
			
			$td = $tr->appendChild(new DOMElement('td'));
			if($stato and $modify)
			{
				$input = $td->appendChild(new DOMElement('input'));
				$input->setAttribute('id',$istanzecol['tipo_operazione'].$val);
				$input->setAttribute('name',$istanzecol['tipo_operazione'].$val);
				$input->setAttribute('value',$prestazioni[$val]['tipo_operazione']);
				$input->setAttribute('type','text');
				$input->setAttribute('size','17');
				$input->setAttribute('readonly','readonly');
			}
			else
			{
				$select = $td->appendChild(new DOMElement('select'));
				$select->setAttribute('id',$istanzecol['tipo_operazione'].$val);
				$select->setAttribute('name',$istanzecol['tipo_operazione'].$val);
				$select->setAttribute('onclick',"calcolaFattura()");
				$option = $select->appendChild(new DOMElement('option'));
				$option->setAttribute('value','');
				$values = array('imponibile','non imponibile','esente');
				foreach($values as $value)
				{
					$option = $select->appendChild(new DOMElement('option'));
					$option->setAttribute('value',$value);
					$option->appendChild($this->htmlDom->createTextNode($value));
					if($modify)
						if($value == $prestazioni[$val]['tipo_operazione'])
							$option->setAttribute('selected','selected');
				}
				if(!$modify)
					$select->setAttribute('disabled','disabled');
			}
			
			$td = $tr->appendChild(new DOMElement('td'));
			if($stato and $modify)
			{
				$input = $td->appendChild(new DOMElement('input'));
				$input->setAttribute('id',$istanzecol['tipo_esenzione'].$val);
				$input->setAttribute('name',$istanzecol['tipo_esenzione'].$val);
				$input->setAttribute('value',$prestazioni[$val]['tipo_esenzione']);
				$input->setAttribute('type','text');
				$input->setAttribute('size','47');
				$input->setAttribute('readonly','readonly');
			}
			else
			{
				$select = $td->appendChild(new DOMElement('select'));
				$select->setAttribute('id',$istanzecol['tipo_esenzione'].$val);
				$select->setAttribute('name',$istanzecol['tipo_esenzione'].$val);
				$select->setAttribute('onclick',"calcolaFattura()");
				$option = $select->appendChild(new DOMElement('option'));
				$option->setAttribute('value','');
				$option->appendChild($this->htmlDom->createTextNode(''));
				$values = array('N.C.','Operazione esente da IVA Art 10 DPR 633/72','Operazione esente da IVA Art 12 DPR 633/72');
				foreach($values as $value)
				{
					$option = $select->appendChild(new DOMElement('option'));
					$option->setAttribute('value',$value);
					$option->appendChild($this->htmlDom->createTextNode($value));
					if($modify)
						if($value == $prestazioni[$val]['tipo_esenzione'])
							$option->setAttribute('selected','selected');
				}
				if(!$modify)
					$select->setAttribute('disabled','disabled');
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
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawFattureForm($container,$columns,$result=null)
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
		$b->appendChild($this->htmlDom->createTextNode("Totale Prestazione"));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Imponibile + IVA"));
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['totale_prestazione']);
		$input->setAttribute('name',$columns['totale_prestazione']);
		$input->setAttribute('size','14');
		$input->setAttribute('readonly','readonly');
		if($modify)
			$input->setAttribute('value',$result['totale_prestazione']);
		else
			$input->setAttribute('value','0.00');
		$br = $td->appendChild(new DOMElement('br'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['totale_imponibile-IVA']);
		$input->setAttribute('name',$columns['totale_imponibile-IVA']);
		$input->setAttribute('size','14');
		$input->setAttribute('readonly','readonly');
		if($modify)
			$input->setAttribute('value',$result['totale_imponibile-IVA']);
		else
			$input->setAttribute('value','0.00');
		$br = $td->appendChild(new DOMElement('br'));
			
		$tr = $table->appendChild(new DOMElement('tr'));				
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Totale Enpav"));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Ritenuta d'Acconto"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','checkbox');
		$input->setAttribute('id','ritenuta');
		$input->setAttribute('class','checkbox');
		$input->setAttribute('onclick',"calcolaFattura()");
		if($modify)
		{
			if($result['ritenuta_di_acconto']!='0.00')
				$input->setAttribute('checked','checked');
			if($result['stato'] == 'Pagata')
				$input->setAttribute('disabled','disabled');
		}
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['totale_enpav']);
		$input->setAttribute('name',$columns['totale_enpav']);
		$input->setAttribute('size','14');
		$input->setAttribute('readonly','readonly');
		if($modify)
			$input->setAttribute('value',$result['totale_enpav']);
		else
			$input->setAttribute('value','0.00');
		$br = $td->appendChild(new DOMElement('br'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['ritenuta_di_acconto']);
		$input->setAttribute('name',$columns['ritenuta_di_acconto']);
		$input->setAttribute('size','14');
		$input->setAttribute('readonly','readonly');
		if($modify)
			$input->setAttribute('value',$result['ritenuta_di_acconto']);
		else
			$input->setAttribute('value','0.00');
		$br = $td->appendChild(new DOMElement('br'));
			
		$tr = $table->appendChild(new DOMElement('tr'));				
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Imponibile"));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Totale Fattura"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','checkbox');
		$input->setAttribute('id','calcolo_manuale');
		$input->setAttribute('class','checkbox');
		$input->setAttribute('onclick',"calcolaManuale()");
		if($modify)
		{
			if($result['stato'] == 'Pagata')
				$input->setAttribute('disabled','disabled');
		}
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['totale_imponibile']);
		$input->setAttribute('name',$columns['totale_imponibile']);
		$input->setAttribute('size','14');
		$input->setAttribute('readonly','readonly');
		if($modify)
			$input->setAttribute('value',$result['totale_imponibile']);
		else
			$input->setAttribute('value','0.00');
		$br = $td->appendChild(new DOMElement('br'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['totale_fattura']);
		$input->setAttribute('name',$columns['totale_fattura']);
		$input->setAttribute('size','14');
		$input->setAttribute('onchange',"calcolaFatturadaTotale()");
		$input->setAttribute('readonly','readonly');
		if($modify)
			$input->setAttribute('value',$result['totale_fattura']);
		else
			$input->setAttribute('value','0.00');
		$br = $td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));				
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Totale IVA"));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Stato Fattura"));
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['totale_IVA']);
		$input->setAttribute('name',$columns['totale_IVA']);
		$input->setAttribute('size','14');
		$input->setAttribute('readonly','readonly');
		if($modify)
			$input->setAttribute('value',$result['totale_IVA']);
		else
			$input->setAttribute('value','0.00');
		$br = $td->appendChild(new DOMElement('br'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['stato']);
		$input->setAttribute('value','Pagata');
		$input->appendChild($this->htmlDom->createTextNode("Pagata"));
		if($modify)
			if($result['stato'] == 'Pagata')
				$input->setAttribute('checked','checked');
		$br = $td->appendChild(new DOMElement('br'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radioleft');
		$input->setAttribute('name',$columns['stato']);
		$input->setAttribute('value','Non Pagata');
		$input->appendChild($this->htmlDom->createTextNode("Non Pagata"));
		if(!$modify)
			$input->setAttribute('checked','checked');
		else if($result['stato'] == 'Non Pagata')
			$input->setAttribute('checked','checked');
			
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
	function drawFattureFiltro($container,$anno=null,$mese=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Archivio Fatture'));
		
		$div2 = $div->appendChild(new DOMElement('div'));
		$div2->setAttribute('id','tablediv');
		$table = $div2->appendChild(new DOMElement('table'));
		$table->setAttribute('class','headtabfirst');
		
		$tr = $table->appendChild(new DOMElement('tr'));				
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Filtri"));
		$br = $td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Mese"));
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','mese');
		$select->setAttribute('name','mese');
		$select->setAttribute('onchange',"submit()");
		$option = $select->appendChild(new DOMElement('option'));
		$option->appendChild($this->htmlDom->createTextNode(''));
		$option->setAttribute('value','');
		$values = array(1=>"Gennaio",2=>"Febbraio",
						3=>"Marzo",4=>"Aprile",
						5=>"Maggio",6=>"Giugno",
						7=>"Luglio",8=>"Agosto",
						9=>"Settembre",10=>"Ottobre",
						11=>"Novembre",12=>"Dicembre");
		foreach($values as $key=>$value)
		{
			$option = $select->appendChild(new DOMElement('option'));
			$option->setAttribute('value',$key);
			$option->appendChild($this->htmlDom->createTextNode($value));
			if(!is_null($mese))
				if($key == $mese)
					$option->setAttribute('selected','selected');
		}
		
		$tr = $table->appendChild(new DOMElement('tr'));				
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Anno"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','anno');
		$input->setAttribute('name','anno');
		$input->setAttribute('size',10);
		$input->setAttribute('value',$anno);
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawFatturato($container,$fatture=null)
	{
		$div = $this->getElementById($container);
				
		$imponibile = 0;
		$iva = 0;
		$totale = 0;
		if(!is_null($fatture))
		{
			while($rows = mysql_fetch_assoc($fatture))
			{
				$imponibile+=$rows["totale_imponibile"];
				$iva+=$rows["totale_IVA"];
				$totale+=$rows["totale_fattura"];
			}
		}
		
		$div2 = $div->appendChild(new DOMElement('div'));
		$div2->setAttribute('id','tablediv');
		$table = $div2->appendChild(new DOMElement('table'));
		$table->setAttribute('class','headtab');
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Totale IVA"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','totiva');
		$input->setAttribute('name','totiva');
		$input->setAttribute('size','10');
		$input->setAttribute('readonly','readonly');
		if(is_null($fatture))
			$input->setAttribute('value','0.00');
		else
			$input->setAttribute('value',$iva);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Totale Imponibile"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','totimponibile');
		$input->setAttribute('name','totimponibile');
		$input->setAttribute('size','10');
		$input->setAttribute('readonly','readonly');
		if(is_null($fatture))
			$input->setAttribute('value','0.00');
		else
			$input->setAttribute('value',$imponibile);
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$b = $p->appendChild(new DOMElement('b'));
		$b->appendChild($this->htmlDom->createTextNode("Totale Fatturato"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','totfatturato');
		$input->setAttribute('name','totfatturato');
		$input->setAttribute('size','10');
		$input->setAttribute('readonly','readonly');
		if(is_null($fatture))
			$input->setAttribute('value','0.00');
		else
			$input->setAttribute('value',$totale);
	}
	
	//////////////////////////////////////////////////////////////////	
	///
	///
	///
	//////////////////////////////////////////////////////////////////	
	function drawFattureList($page,$container,$values,$columns,$customs=null)
	{
		$div = $this->getElementById($container);
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('id','archiviotab');
		
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

}

?>
