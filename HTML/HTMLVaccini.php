<?

class HTMLVaccini extends HTML
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
	function drawVaccinoSchema($container,$eta,$columns,$paziente,$result=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Vaccini per Cucciolo'));
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
		
		$posizione = array('1'=>'PRIMO','2'=>'SECONDO','3'=>'TERZO','4'=>'QUARTO');
		
		if($eta == 'cucciolo')
			$tipi= array( 
			'Canina' => array('1'=>'Parvo-Cimurro','2'=>'Polivalente','3'=>'Polivalente','4'=>'Polivalente'),
			'Felina' => array('1'=>'Trivalente','2'=>'Trivalente','3'=>'Trivalente'),
			'Leporide' => array('1'=>'MEV','2'=>'Mixomatosi','3'=>'MEV','4'=>'Mixomatosi')
			);
		if($eta == 'adulto')
			$tipi= array( 
			'Canina' => array('1'=>'Polivalente','2'=>'Polivalente','3'=>'Polivalente'),
			'Felina' => array('1'=>'Trivalente','2'=>'Leucemia Felina','3'=>'Trivalente','4'=>'Leucemia Felina'),
			'Leporide' => array('1'=>'MEV','2'=>'Mixomatosi','3'=>'MEV','4'=>'Mixomatosi')
			);
		
		for($i=1;$i<count($tipi[$paziente['specie']])+1;$i++)
		{
			$tr = $table->appendChild(new DOMElement('tr'));		
			$td = $tr->appendChild(new DOMElement('td'));
			$td->appendChild(new DOMElement('br'));
			$td->setAttribute('colspan','2');
			$p = $td->appendChild(new DOMElement('p'));
			$p->setAttribute('class','title');
			$p->appendChild($this->htmlDom->createTextNode($posizione[$i]." VACCINO"));
			$td->appendChild(new DOMElement('br'));
			
			$tr = $table->appendChild(new DOMElement('tr'));			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Tipo"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$columns['tipo'].$i);
			$input->setAttribute('name',$columns['tipo'].$i);
			$input->setAttribute('size','60');
			$input->setAttribute('maxlength','50');
			$input->setAttribute('value',$tipi[$paziente['specie']][$i]);
			$td = $tr->appendChild(new DOMElement('td'));
			$select = $td->appendChild(new DOMElement('select'));
			$select->setAttribute('id','tipo_options'.$i);
			$select->setAttribute('onclick',"setEsame(this.id)");
			
			$tr = $table->appendChild(new DOMElement('tr'));			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Marca"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$columns['marca'].$i);
			$input->setAttribute('name',$columns['marca'].$i);
			$input->setAttribute('size','70');
			$input->setAttribute('maxlength','60');
				
			$tr = $table->appendChild(new DOMElement('tr'));
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Data Vaccino"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('onchange','datadiff('.$i.')');
			if($i==1)
				$input->setAttribute('id','datepicker');
			else
				$input->setAttribute('id',$columns['data_vaccino'].$i);
			$input->setAttribute('name',$columns['data_vaccino'].$i);
			$input->setAttribute('size','11');
			$input->setAttribute('maxlength','10');
			if($i==1)
				$input->setAttribute('value',date("d/m/Y"));
			else if($paziente['specie'] == 'Leporide')
			{
				if($i==2)
				{
					$days = 21*($i-1);
					$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
				}
				else if($i==3)
				{
					$days = 182+21;
					$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
				}
				else if($i==4)
				{
					$days = 182+42;
					$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
				}
			}
			else
			{
				$days = 21*($i-1);
				$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
			}
			
			$tr = $table->appendChild(new DOMElement('tr'));			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Durata(gg)"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$columns['durata'].$i);
			$input->setAttribute('name',$columns['durata'].$i);
			$input->setAttribute('size','4');
			$input->setAttribute('maxlength','3');
			$input->setAttribute('onchange','datadiff('.$i.')');
			if($paziente['specie'] == "Leporide")
			{
				if($i==1 or $i==3)
					$input->setAttribute('value',21);
				else
					$input->setAttribute('value',182);
			}
			else if($i==count($tipi[$paziente['specie']]))
				$input->setAttribute('value',365);
			else
				$input->setAttribute('value',21);
			
			$tr = $table->appendChild(new DOMElement('tr'));
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Data Richiamo"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$columns['data_scadenza'].$i);
			$input->setAttribute('name',$columns['data_scadenza'].$i);
			$input->setAttribute('size','11');
			$input->setAttribute('maxlength','10');
			if($paziente['specie'] == "Leporide")
			{
				if($i==1)
				{
					$days = 21;
					$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
				}
				else if($i==2)
				{
					$days = 182+21;
					$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
				}
				else if($i==3)
				{
					$days = 182+42;
					$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
				}
				else if($i==4)
				{
					$days = 365;
					$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
				}
			}
			else if($i==count($tipi[$paziente['specie']]))
			{
				$days = 365+21*($i-1);
				$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
			}
			else
			{
				$days = 21*$i;
				$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
			}		
			
			$tr = $table->appendChild(new DOMElement('tr'));			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("E-Mail di Avviso?"));
			$td = $tr->appendChild(new DOMElement('td'));
			$span = $td->appendChild(new DOMElement('span'));
			$span->appendChild($this->htmlDom->createTextNode("Si"));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','radio');
			$input->setAttribute('class','radio');
			$input->setAttribute('name',$columns['avviso'].$i);
			$input->setAttribute('value','2');
			$input->setAttribute('checked','checked');
			$span = $td->appendChild(new DOMElement('span'));
			$span->appendChild($this->htmlDom->createTextNode("No"));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','radio');
			$input->setAttribute('class','radio');
			$input->setAttribute('name',$columns['avviso'].$i);
			$input->setAttribute('value','1');
			
			$tr = $table->appendChild(new DOMElement('tr'));
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Data Avviso"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$columns['data_avviso'].$i);
			$input->setAttribute('name',$columns['data_avviso'].$i);
			$input->setAttribute('size','11');
			$input->setAttribute('maxlength','10');
			if($paziente['specie'] == "Leporide")
			{
				if($i==1)
				{
					$days = 21-3;
					$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
				}
				else if($i==2)
				{
					$days = 182+21-3;
					$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
				}
				else if($i==3)
				{
					$days = 182+42-3;
					$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
				}
				else if($i==4)
				{
					$days = 365-3;
					$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
				}
			}
			else if($i==count($tipi[$paziente['specie']]))
			{
				$days = 362+21*($i-1);
				$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
			}
			else
			{
				$days = 21*$i-3;
				$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
			}
				
			$tr = $table->appendChild(new DOMElement('tr'));			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Stato"));
			$td = $tr->appendChild(new DOMElement('td'));
			$span = $td->appendChild(new DOMElement('span'));
			$span->appendChild($this->htmlDom->createTextNode("Effettuato"));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','radio');
			$input->setAttribute('class','radio');
			$input->setAttribute('name',$columns['stato'].$i);
			$input->setAttribute('value','2');
			$span = $td->appendChild(new DOMElement('span'));
			$span->appendChild($this->htmlDom->createTextNode("Non Effettuato"));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','radio');
			$input->setAttribute('class','radio');
			$input->setAttribute('name',$columns['stato'].$i);
			$input->setAttribute('value','1');
			$input->setAttribute('checked','checked');
			
			$tr = $table->appendChild(new DOMElement('tr'));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','hidden');
			$input->setAttribute('id',$columns['successivo'].$i);
			$input->setAttribute('name',$columns['successivo'].$i);
			if($i!=count($tipi[$paziente['specie']]))
				$input->setAttribute('value','NO');
			else
				$input->setAttribute('value','SI');
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
	function drawVaccino($container,$columns,$paziente,$result=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Vaccino'));
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('class','esamitab');
		
		$modify = !is_null($result);
		
		$tipi= array( 
			'Canina' => 'Polivalente',
			'Felina' => 'Trivalente',
			'Leporide' => 'MEV'
			);
		
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
		$td->appendChild(new DOMElement('br'));
		$td->setAttribute('colspan','2');
		$p = $td->appendChild(new DOMElement('p'));
		$p->setAttribute('class','title');
		$p->appendChild($this->htmlDom->createTextNode("DATI VACCINO"));
		$td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Tipo"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['tipo'].'1');
		$input->setAttribute('name',$columns['tipo'].'1');
		$input->setAttribute('size','60');
		$input->setAttribute('maxlength','50');
		if($modify)
			$input->setAttribute('value',$result['tipo']);
		else
			$input->setAttribute('value',$tipi[$paziente['specie']]);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','tipo_options1');
		$select->setAttribute('onclick',"setEsame(this.id)");
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Marca"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['marca'].'1');
		$input->setAttribute('name',$columns['marca'].'1');
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['marca']);
			
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Data Vaccino"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','datepicker');
		$input->setAttribute('name',$columns['data_vaccino'].'1');
		$input->setAttribute('size','11');
		$input->setAttribute('maxlength','10');
		$input->setAttribute('onchange','datadiff(1)');
		if($modify and $result['data_vaccino']!=null)
		{
			$data = explode('-',$result['data_vaccino']);
			$input->setAttribute('value',"$data[2]/$data[1]/$data[0]");
		}
		else
			$input->setAttribute('value',date("d/m/Y"));
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Durata(gg)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['durata'].'1');
		$input->setAttribute('name',$columns['durata'].'1');
		$input->setAttribute('size','4');
		$input->setAttribute('maxlength','3');
		$input->setAttribute('onchange','datadiff(1)');
		if($modify)
			$input->setAttribute('value',$result['durata']);
		else if($paziente['specie'] == 'Leporide')
			$input->setAttribute('value',182);
		else
			$input->setAttribute('value',365);
			
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Data Richiamo"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['data_scadenza'].'1');
		$input->setAttribute('name',$columns['data_scadenza'].'1');
		$input->setAttribute('size','11');
		$input->setAttribute('maxlength','10');
		if($modify and $result['data_scadenza']!=null)
		{
			$data = explode('-',$result['data_scadenza']);
			$input->setAttribute('value',"$data[2]/$data[1]/$data[0]");
		}
		else if($paziente['specie'] == 'Leporide')
			$input->setAttribute('value',date("d/m/Y", strtotime("+182 day")));
		else
			$input->setAttribute('value',date("d/m/Y", strtotime("+365 day")));
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("E-Mail di Avviso?"));
		$td = $tr->appendChild(new DOMElement('td'));
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("Si"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['avviso'].'1');
		$input->setAttribute('value','2');
		if(!$modify)
			$input->setAttribute('checked','checked');
		else if($result['avviso'] == '2')
			$input->setAttribute('checked','checked');
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("No"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['avviso'].'1');
		$input->setAttribute('value','1');
		if($modify)
			if($result['avviso'] == '1')
				$input->setAttribute('checked','checked');
				
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Data Avviso"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['data_avviso'].'1');
		$input->setAttribute('name',$columns['data_avviso'].'1');
		$input->setAttribute('size','11');
		$input->setAttribute('maxlength','10');
		if($modify and $result['data_avviso']!=null)
		{
			$data = explode('-',$result['data_avviso']);
			$input->setAttribute('value',"$data[2]/$data[1]/$data[0]");
		}
		else if($paziente['specie'] == 'Leporide')
			$input->setAttribute('value',date("d/m/Y", strtotime("+179 day")));
		else
			$input->setAttribute('value',date("d/m/Y", strtotime("+362 day")));
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Stato"));
		$td = $tr->appendChild(new DOMElement('td'));
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("Effettuato"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['stato'].'1');
		$input->setAttribute('value','2');
		if($modify)
			if($result['stato'] == '2')
				$input->setAttribute('checked','checked');
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("Non Effettuato"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['stato'].'1');
		$input->setAttribute('value','1');
		if(!$modify)
			$input->setAttribute('checked','checked');
		else if($result['stato'] == '1')
			$input->setAttribute('checked','checked');
			
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','hidden');
		$input->setAttribute('id',$columns['successivo'].'1');
		$input->setAttribute('name',$columns['successivo'].'1');
		if($modify)
			$input->setAttribute('value',$result['successivo']);
		else
			$input->setAttribute('value','SI');
					
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
	function drawSverminazioneCucciolo($container,$columns,$paziente,$result=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Sverminazione'));
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
		
		$posizione = array('1'=>'PRIMA','2'=>'SECONDA','3'=>'TERZA','4'=>'QUARTA');
		
		$tipi= array( 
			'Canina' => array('1'=>'Vermifugo','2'=>'Vermifugo','3'=>'Vermifugo'),
			'Felina' => array('1'=>'Vermifugo','2'=>'Vermifugo','3'=>'Vermifugo'),
			'Leporide' => array('1'=>'Vermifugo','2'=>'Vermifugo','3'=>'Vermifugo')
		);
		
		for($i=1;$i<count($tipi[$paziente['specie']])+1;$i++)
		{
			$tr = $table->appendChild(new DOMElement('tr'));		
			$td = $tr->appendChild(new DOMElement('td'));
			$td->appendChild(new DOMElement('br'));
			$td->setAttribute('colspan','2');
			$p = $td->appendChild(new DOMElement('p'));
			$p->setAttribute('class','title');
			$p->appendChild($this->htmlDom->createTextNode($posizione[$i]." SVERMINAZIONE"));
			$td->appendChild(new DOMElement('br'));
			
			$tr = $table->appendChild(new DOMElement('tr'));			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Tipo"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$columns['tipo'].$i);
			$input->setAttribute('name',$columns['tipo'].$i);
			$input->setAttribute('size','60');
			$input->setAttribute('maxlength','50');
			$input->setAttribute('value',$tipi[$paziente['specie']][$i]);
			
			$tr = $table->appendChild(new DOMElement('tr'));			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Marca"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$columns['marca'].$i);
			$input->setAttribute('name',$columns['marca'].$i);
			$input->setAttribute('size','70');
			$input->setAttribute('maxlength','60');
				
			$tr = $table->appendChild(new DOMElement('tr'));
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Data Vaccino"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('onchange','datadiff('.$i.')');
			if($i==1)
				$input->setAttribute('id','datepicker');
			else
				$input->setAttribute('id',$columns['data_vaccino'].$i);
			$input->setAttribute('name',$columns['data_vaccino'].$i);
			$input->setAttribute('size','11');
			$input->setAttribute('maxlength','10');
			if($i==1)
				$input->setAttribute('value',date("d/m/Y"));
			else
			{
				$days = 21*($i-1);
				$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
			}
			
			$tr = $table->appendChild(new DOMElement('tr'));			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Durata(gg)"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$columns['durata'].$i);
			$input->setAttribute('name',$columns['durata'].$i);
			$input->setAttribute('size','4');
			$input->setAttribute('maxlength','3');
			if($i==count($tipi[$paziente['specie']]))
				$input->setAttribute('value',183);
			else
				$input->setAttribute('value',21);
			
			$tr = $table->appendChild(new DOMElement('tr'));
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Data Richiamo"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$columns['data_scadenza'].$i);
			$input->setAttribute('name',$columns['data_scadenza'].$i);
			$input->setAttribute('size','11');
			$input->setAttribute('maxlength','10');
			if($i==count($tipi[$paziente['specie']]))
			{
				$days = 183+21*($i-1);
				$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
			}
			else
			{
				$days = 21*$i;
				$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
			}		
			
			$tr = $table->appendChild(new DOMElement('tr'));			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("E-Mail di Avviso?"));
			$td = $tr->appendChild(new DOMElement('td'));
			$span = $td->appendChild(new DOMElement('span'));
			$span->appendChild($this->htmlDom->createTextNode("Si"));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','radio');
			$input->setAttribute('class','radio');
			$input->setAttribute('name',$columns['avviso'].$i);
			$input->setAttribute('value','2');
			$input->setAttribute('checked','checked');
			$span = $td->appendChild(new DOMElement('span'));
			$span->appendChild($this->htmlDom->createTextNode("No"));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','radio');
			$input->setAttribute('class','radio');
			$input->setAttribute('name',$columns['avviso'].$i);
			$input->setAttribute('value','1');
			
			$tr = $table->appendChild(new DOMElement('tr'));
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Data Avviso"));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','text');
			$input->setAttribute('id',$columns['data_avviso'].$i);
			$input->setAttribute('name',$columns['data_avviso'].$i);
			$input->setAttribute('size','11');
			$input->setAttribute('maxlength','10');
			if($i==count($tipi[$paziente['specie']]))
			{
				$days = 180+21*($i-1);
				$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
			}
			else
			{
				$days = 21*$i-3;
				$input->setAttribute('value',date("d/m/Y", strtotime("+$days day")));
			}
				
			$tr = $table->appendChild(new DOMElement('tr'));			
			$td = $tr->appendChild(new DOMElement('td'));
			$p = $td->appendChild(new DOMElement('p'));
			$p->appendChild($this->htmlDom->createTextNode("Stato"));
			$td = $tr->appendChild(new DOMElement('td'));
			$span = $td->appendChild(new DOMElement('span'));
			$span->appendChild($this->htmlDom->createTextNode("Effettuato"));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','radio');
			$input->setAttribute('class','radio');
			$input->setAttribute('name',$columns['stato'].$i);
			$input->setAttribute('value','2');
			$span = $td->appendChild(new DOMElement('span'));
			$span->appendChild($this->htmlDom->createTextNode("Non Effettuato"));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','radio');
			$input->setAttribute('class','radio');
			$input->setAttribute('name',$columns['stato'].$i);
			$input->setAttribute('value','1');
			$input->setAttribute('checked','checked');
			
			$tr = $table->appendChild(new DOMElement('tr'));
			$td = $tr->appendChild(new DOMElement('td'));
			$input = $td->appendChild(new DOMElement('input'));
			$input->setAttribute('type','hidden');
			$input->setAttribute('id',$columns['successivo'].$i);
			$input->setAttribute('name',$columns['successivo'].$i);
			if($i!=count($tipi[$paziente['specie']]))
				$input->setAttribute('value','NO');
			else
				$input->setAttribute('value','SI');
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
	function drawSverminazione($container,$columns,$paziente,$result=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Sverminazione'));
		$table = $div->appendChild(new DOMElement('table'));
		$table->setAttribute('class','esamitab');
		
		$modify = !is_null($result);
		
		$tipi= array( 
			'Canina' => 'Polivalente',
			'Felina' => 'Trivalente',
			'Leporide' => 'Trivalente'
			);
		
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
		$td->appendChild(new DOMElement('br'));
		$td->setAttribute('colspan','2');
		$p = $td->appendChild(new DOMElement('p'));
		$p->setAttribute('class','title');
		$p->appendChild($this->htmlDom->createTextNode("DATI SVERMINAZIONE"));
		$td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Tipo"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['tipo'].'1');
		$input->setAttribute('name',$columns['tipo'].'1');
		$input->setAttribute('size','60');
		$input->setAttribute('maxlength','50');
		if($modify)
			$input->setAttribute('value',$result['tipo']);
		else
			$input->setAttribute('value','Vermifugo');
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Marca"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['marca'].'1');
		$input->setAttribute('name',$columns['marca'].'1');
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['marca']);
			
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Data Sverminazione"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id','datepicker');
		$input->setAttribute('name',$columns['data_vaccino'].'1');
		$input->setAttribute('size','11');
		$input->setAttribute('maxlength','10');
		$input->setAttribute('onchange','datadiff(1)');
		if($modify and $result['data_vaccino']!=null)
		{
			$data = explode('-',$result['data_vaccino']);
			$input->setAttribute('value',"$data[2]/$data[1]/$data[0]");
		}
		else
			$input->setAttribute('value',date("d/m/Y"));
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Durata(gg)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['durata'].'1');
		$input->setAttribute('name',$columns['durata'].'1');
		$input->setAttribute('size','4');
		$input->setAttribute('maxlength','3');
		$input->setAttribute('onchange','datadiff(1)');
		if($modify)
			$input->setAttribute('value',$result['durata']);
		else
			$input->setAttribute('value',183);
			
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Data Richiamo"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['data_scadenza'].'1');
		$input->setAttribute('name',$columns['data_scadenza'].'1');
		$input->setAttribute('size','11');
		$input->setAttribute('maxlength','10');
		if($modify and $result['data_scadenza']!=null)
		{
			$data = explode('-',$result['data_scadenza']);
			$input->setAttribute('value',"$data[2]/$data[1]/$data[0]");
		}
		else
			$input->setAttribute('value',date("d/m/Y", strtotime("+183 day")));
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("E-Mail di Avviso?"));
		$td = $tr->appendChild(new DOMElement('td'));
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("Si"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['avviso'].'1');
		$input->setAttribute('value','2');
		if(!$modify)
			$input->setAttribute('checked','checked');
		else if($result['avviso'] == '2')
			$input->setAttribute('checked','checked');
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("No"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['avviso'].'1');
		$input->setAttribute('value','1');
		if($modify)
			if($result['avviso'] == '1')
				$input->setAttribute('checked','checked');
				
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Data Avviso"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['data_avviso'].'1');
		$input->setAttribute('name',$columns['data_avviso'].'1');
		$input->setAttribute('size','11');
		$input->setAttribute('maxlength','10');
		if($modify and $result['data_avviso']!=null)
		{
			$data = explode('-',$result['data_avviso']);
			$input->setAttribute('value',"$data[2]/$data[1]/$data[0]");
		}
		else
			$input->setAttribute('value',date("d/m/Y", strtotime("+180 day")));
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Stato"));
		$td = $tr->appendChild(new DOMElement('td'));
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("Effettuato"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['stato'].'1');
		$input->setAttribute('value','2');
		if($modify)
			if($result['stato'] == '2')
				$input->setAttribute('checked','checked');
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("Non Effettuato"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['stato'].'1');
		$input->setAttribute('value','1');
		if(!$modify)
			$input->setAttribute('checked','checked');
		else if($result['stato'] == '1')
			$input->setAttribute('checked','checked');
		
		$tr = $table->appendChild(new DOMElement('tr'));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','hidden');
		$input->setAttribute('id',$columns['successivo'].'1');
		$input->setAttribute('name',$columns['successivo'].'1');
		if($modify)
			$input->setAttribute('value',$result['successivo']);
		else
			$input->setAttribute('value','SI');
			
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
	function drawVacciniOption($id,$options,$modify,$selected=null)
	{
		$select = $this->getElementById($id);
		
		foreach($options as $key=>$val)
		{
			$option = $select->appendChild(new DOMElement('option'));
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
				if($value['layout'] == 'Data scadenza')
					$p->appendChild($this->htmlDom->createTextNode('Data richiamo'));
				else
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
				foreach($rows as $key=>$row)
				{
					$td = $tr->appendChild(new DOMElement('td'));
					$p = $td->appendChild(new DOMElement('p'));
					if(preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/',$row) and $row!=null)
					{
						$data = explode("-",$row);
						$p->appendChild($this->htmlDom->createTextNode("$data[2]/$data[1]/$data[0]"));
					}
					else if ($row==1 and $key=="stato")
					{
						$p->appendChild($this->htmlDom->createTextNode("Non Effettuato"));
					}
					else if ($row==2 and $key=="stato")
					{
						$p->appendChild($this->htmlDom->createTextNode("Effettuato"));
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
