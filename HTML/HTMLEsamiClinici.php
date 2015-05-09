<?

class HTMLEsamiClinici extends HTML
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
	function drawAnamnesi($container,$columns,$colclinico,$paziente,$result=null,$clinico=null)
	{
		$div = $this->getElementById($container);
		$h3 = $div->appendChild(new DOMElement('h3'));
		$h3->appendChild($this->htmlDom->createTextNode('Esame Clinico/Generale'));
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
		$p->appendChild($this->htmlDom->createTextNode("ANAMNESI"));
		$td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Ambiente di Vita"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['ambiente_di_vita']);
		$input->setAttribute('name',$columns['ambiente_di_vita']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['ambiente_di_vita']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','ambiente_di_vita_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Appetito"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['appetito']);
		$input->setAttribute('name',$columns['appetito']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['appetito']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','appetito_options');
		$select->setAttribute('onclick',"setEsame(this.id)");

		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Consumo Acqua"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['consumo_acqua']);
		$input->setAttribute('name',$columns['consumo_acqua']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['consumo_acqua']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','consumo_acqua_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Feci"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['feci']);
		$input->setAttribute('name',$columns['feci']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['feci']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','feci_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Urine"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['urine']);
		$input->setAttribute('name',$columns['urine']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['urine']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','urine_options');
		$select->setAttribute('onclick',"setEsame(this.id)");

		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Presenza altri Animali"));
		$td = $tr->appendChild(new DOMElement('td'));
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("Si"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['altri_animali']);
		$input->setAttribute('value','2');
		if($modify)
			if($result['altri_animali'] == '2')
				$input->setAttribute('checked','checked');
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("No"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['altri_animali']);
		$input->setAttribute('value','1');
		if(!$modify)
			$input->setAttribute('checked','checked');
		else if($result['altri_animali'] == '1')
			$input->setAttribute('checked','checked');

		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Sverminazione in regola"));
		$td = $tr->appendChild(new DOMElement('td'));
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("Si"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['sverminazione']);
		$input->setAttribute('value','2');
		if($modify)
			if($result['sverminazione'] == '2')
				$input->setAttribute('checked','checked');
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("No"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['sverminazione']);
		$input->setAttribute('value','1');
		if(!$modify)
			$input->setAttribute('checked','checked');
		else if($result['sverminazione'] == '1')
			$input->setAttribute('checked','checked');
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Vaccinazioni in regola"));
		$td = $tr->appendChild(new DOMElement('td'));
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("Si"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['vaccinazione']);
		$input->setAttribute('value','2');
		if($modify)
			if($result['vaccinazione'] == '2')
				$input->setAttribute('checked','checked');
		$span = $td->appendChild(new DOMElement('span'));
		$span->appendChild($this->htmlDom->createTextNode("No"));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','radio');
		$input->setAttribute('class','radio');
		$input->setAttribute('name',$columns['vaccinazione']);
		$input->setAttribute('value','1');
		if(!$modify)
			$input->setAttribute('checked','checked');
		else if($result['vaccinazione'] == '1')
			$input->setAttribute('checked','checked');
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Regime Alimentare"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$columns['regime_alimentare']);
		$input->setAttribute('name',$columns['regime_alimentare']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$result['regime_alimentare']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','regime_alimentare_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Terapie"));
		$td = $tr->appendChild(new DOMElement('td'));
		$textarea = $td->appendChild(new DOMElement('textarea'));
		$textarea->setAttribute('id',$columns['terapie']);
		$textarea->setAttribute('name',$columns['terapie']);	
		if($modify)
			$textarea->appendChild($this->htmlDom->createTextNode($result['terapie']));
		
		///////////////////////CLINICO///////////////////////////////
		
		$td->appendChild(new DOMElement('br'));
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$td->setAttribute('colspan','2');
		$p = $td->appendChild(new DOMElement('p'));
		$p->setAttribute('class','title');
		$p->appendChild($this->htmlDom->createTextNode("ESAME CLINICO"));
		$td->appendChild(new DOMElement('br'));
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Nutrizione"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['nutrizione']);
		$input->setAttribute('name',$colclinico['nutrizione']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$clinico['nutrizione']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','nutrizione_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Cute"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['cute']);
		$input->setAttribute('name',$colclinico['cute']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$clinico['cute']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','cute_options');
		$select->setAttribute('onclick',"setEsame(this.id)");

		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Narici"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['narici']);
		$input->setAttribute('name',$colclinico['narici']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$clinico['narici']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','narici_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Mucose Oculari"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['mucose_oculari']);
		$input->setAttribute('name',$colclinico['mucose_oculari']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$clinico['mucose_oculari']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','mucose_oculari_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Mucose Orali"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['mucose_orali']);
		$input->setAttribute('name',$colclinico['mucose_orali']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$clinico['mucose_orali']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','mucose_orali_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Denti"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['denti']);
		$input->setAttribute('name',$colclinico['denti']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$clinico['denti']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','denti_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Linfonodi"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['linfonodi']);
		$input->setAttribute('name',$colclinico['linfonodi']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$clinico['linfonodi']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','linfonodi_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Orecchie"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['orecchie']);
		$input->setAttribute('name',$colclinico['orecchie']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$clinico['orecchie']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','orecchie_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Polso"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['polso']);
		$input->setAttribute('name',$colclinico['polso']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$clinico['polso']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','polso_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Cuore"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['cuore']);
		$input->setAttribute('name',$colclinico['cuore']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');
		if($modify)
			$input->setAttribute('value',$clinico['cuore']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','cuore_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Respiro"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['respiro']);
		$input->setAttribute('name',$colclinico['respiro']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');	
		if($modify)
			$input->setAttribute('value',$clinico['respiro']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','respiro_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Palpazione Addome"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['palpazione_addome']);
		$input->setAttribute('name',$colclinico['palpazione_addome']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');	
		if($modify)
			$input->setAttribute('value',$clinico['palpazione_addome']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','palpazione_addome_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Palpazione Mammelle"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['palpazione_mammelle']);
		$input->setAttribute('name',$colclinico['palpazione_mammelle']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');	
		if($modify)
			$input->setAttribute('value',$clinico['palpazione_mammelle']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','palpazione_mammelle_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Palpazione Testicoli"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['palpazione_testicoli']);
		$input->setAttribute('name',$colclinico['palpazione_testicoli']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');	
		if($modify)
			$input->setAttribute('value',$clinico['palpazione_testicoli']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','palpazione_testicoli_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Stato del Sensorio"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['stato_del_sensorio']);
		$input->setAttribute('name',$colclinico['stato_del_sensorio']);
		$input->setAttribute('size','70');
		$input->setAttribute('maxlength','60');	
		if($modify)
			$input->setAttribute('value',$clinico['stato_del_sensorio']);
		$td = $tr->appendChild(new DOMElement('td'));
		$select = $td->appendChild(new DOMElement('select'));
		$select->setAttribute('id','stato_del_sensorio_options');
		$select->setAttribute('onclick',"setEsame(this.id)");
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Temperatura"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['temperatura']);
		$input->setAttribute('name',$colclinico['temperatura']);
		$input->setAttribute('size','6');
		$input->setAttribute('maxlength','6');	
		if($modify)
			$input->setAttribute('value',$clinico['temperatura']);
			
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Peso(Kg)"));
		$td = $tr->appendChild(new DOMElement('td'));
		$input = $td->appendChild(new DOMElement('input'));
		$input->setAttribute('type','text');
		$input->setAttribute('id',$colclinico['peso']);
		$input->setAttribute('name',$colclinico['peso']);
		$input->setAttribute('size','10');
		$input->setAttribute('maxlength','8');	
		if($modify)
			$input->setAttribute('value',$clinico['peso']);
		
		$tr = $table->appendChild(new DOMElement('tr'));			
		$td = $tr->appendChild(new DOMElement('td'));
		$p = $td->appendChild(new DOMElement('p'));
		$p->appendChild($this->htmlDom->createTextNode("Note"));
		$td = $tr->appendChild(new DOMElement('td'));
		$textarea = $td->appendChild(new DOMElement('textarea'));
		$textarea->setAttribute('id',$colclinico['note']);
		$textarea->setAttribute('name',$colclinico['note']);	
		if($modify)
			$textarea->appendChild($this->htmlDom->createTextNode($clinico['note']));
		
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
