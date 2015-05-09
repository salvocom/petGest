//Datepicker
$(function() {
	$.datepicker.setDefaults( $.datepicker.regional[ "" ] );
	$( "#datepicker" ).datepicker( $.datepicker.regional[ "it" ] );
	$( "#locale" ).change(function() {
	$( "#datepicker" ).datepicker( "option",
	$.datepicker.regional[ $( this ).val() ] );
	});
});

//Data Vaccino 2
$(function() {
	$.datepicker.setDefaults( $.datepicker.regional[ "" ] );
	$( "#data_vaccino2" ).datepicker( $.datepicker.regional[ "it" ] );
	$( "#locale" ).change(function() {
	$( "#data_vaccino2" ).datepicker( "option",
	$.datepicker.regional[ $( this ).val() ] );
	});
});
//Data Vaccino 3
$(function() {
	$.datepicker.setDefaults( $.datepicker.regional[ "" ] );
	$( "#data_vaccino3" ).datepicker( $.datepicker.regional[ "it" ] );
	$( "#locale" ).change(function() {
	$( "#data_vaccino3" ).datepicker( "option",
	$.datepicker.regional[ $( this ).val() ] );
	});
});
//Data Vaccino 4
$(function() {
	$.datepicker.setDefaults( $.datepicker.regional[ "" ] );
	$( "#data_vaccino4" ).datepicker( $.datepicker.regional[ "it" ] );
	$( "#locale" ).change(function() {
	$( "#data_vaccino4" ).datepicker( "option",
	$.datepicker.regional[ $( this ).val() ] );
	});
});
//Datanascita
$(function() {
	$.datepicker.setDefaults( $.datepicker.regional[ "" ] );
	$( "#datanascita" ).datepicker( $.datepicker.regional[ "it" ] );
	$( "#locale" ).change(function() {
	$( "#datanascita" ).datepicker( "option",
	$.datepicker.regional[ $( this ).val() ] );
	});
});

//Datadecesso
$(function() {
	$.datepicker.setDefaults( $.datepicker.regional[ "" ] );
	$( "#datadecesso" ).datepicker( $.datepicker.regional[ "it" ] );
	$( "#locale" ).change(function() {
	$( "#datadecesso" ).datepicker( "option",
	$.datepicker.regional[ $( this ).val() ] );
	});
});

//Contabilità
function calcolaFattura()
{
	somma = new Number();
	IVA = new Number();
	enpav = new Number();
	imponibile = new Number();
	imponibileIVA = new Number();
	totale = new Number();
	
	for(i=1;i<11;i++)
	{
		if(document.getElementById('costo'+i).value != null)
		{
			somma += Number(document.getElementById('quantita'+i).value)*Number(document.getElementById('costo'+i).value);
			if(document.getElementById('enpav'+i).value != null)
			{
				enpavtemp = Number(document.getElementById('quantita'+i).value)*((Number(document.getElementById('costo'+i).value)*Number(document.getElementById('enpav'+i).value))/100);
				enpav += enpavtemp;
			}
			if(document.getElementById('IVA'+i).value != null)
			{
				IVA += Number(document.getElementById('quantita'+i).value)*(((Number(document.getElementById('costo'+i).value)+enpavtemp)*Number(document.getElementById('IVA'+i).value))/100);
			}
		}
	}
	
	somma = round(somma,2);
	somma = somma.toFixed(2);
	IVA = round(IVA,2);
	IVA = IVA.toFixed(2);
	enpav = round(enpav,2);
	enpav = enpav.toFixed(2);
	imponibile = round(parseFloat(somma)+parseFloat(enpav),2);
	imponibile = imponibile.toFixed(2);
	imponibileIVA = round(parseFloat(imponibile)+parseFloat(IVA),2);
	imponibileIVA = imponibileIVA.toFixed(2);

	if(document.form.ritenuta.checked)
	{
		ritenuta = round(somma*20/100,2);
		ritenuta = ritenuta.toFixed(2);
		document.getElementById('ritenuta_di_acconto').value = ritenuta;
		totale = imponibileIVA-ritenuta;
	}
	else
	{
		document.getElementById('ritenuta_di_acconto').value = '0.00';
		totale = imponibileIVA;
	}
	totale = round(totale,2);
	totale = totale.toFixed(2);
	
	document.getElementById('totale_prestazione').value = somma;
	document.getElementById('totale_imponibile-IVA').value = imponibileIVA;
	document.getElementById('totale_enpav').value = enpav;
	document.getElementById('totale_imponibile').value = imponibile;
	document.getElementById('totale_IVA').value = IVA;
	document.getElementById('totale_fattura').value = totale;
}

function calcolaManuale()
{
	if(document.form.calcolo_manuale.checked)
	{
		for(i=2;i<11;i++)
		{
			if(document.getElementById('costo'+i).value != null)
			{
				document.getElementById('descrizione'+i).value = null;
				document.getElementById('quantita'+i).value = null;
				document.getElementById('costo'+i).value = null;
				document.getElementById('enpav'+i).value = '';
				document.getElementById('IVA'+i).value = '';
				document.getElementById('tipo_operazione'+i).value = '';
				document.getElementById('tipo_esenzione'+i).value = '';
				document.getElementById('quantita'+i).disabled = 'disabled';
				document.getElementById('costo'+i).disabled = 'disabled';
				document.getElementById('enpav'+i).disabled = 'disabled';
				document.getElementById('IVA'+i).disabled = 'disabled';
				document.getElementById('tipo_operazione'+i).disabled = 'disabled';
				document.getElementById('tipo_esenzione'+i).disabled = 'disabled';
			}
		}
		document.getElementById('totale_fattura').readOnly = false;
	}
	else
	{
		document.getElementById('totale_fattura').readOnly = true;
	}
}

function calcolaFatturadaTotale()
{		
		somma = new Number();
		IVA = new Number();
		enpav = new Number();
		imponibile = new Number();
		imponibileIVA = new Number();
		totale = Number(document.getElementById('totale_fattura').value);
		totale = totale.toFixed(2);
		
		if(document.getElementById('IVA1').value != null)
			IVA = totale - round(totale/Number('1.'+document.getElementById('IVA1').value),2);
		else
			IVA = '0.00';
		
		IVA = IVA.toFixed(2);
		
		imponibile = round(parseFloat(totale)-parseFloat(IVA),2);
		imponibile = imponibile.toFixed(2);
		
		if(document.getElementById('enpav1').value != null)
			enpav = imponibile - round(imponibile/Number('1.0'+document.getElementById('enpav1').value),2);
		else
			enpav = '0.00';
			
		enpav = enpav.toFixed(2);
			
		prestazione = round(parseFloat(imponibile)-parseFloat(enpav),2);
		prestazione = prestazione.toFixed(2);
		
		document.getElementById('totale_prestazione').value = prestazione;
		document.getElementById('totale_imponibile-IVA').value = totale;
		document.getElementById('totale_enpav').value = enpav;
		document.getElementById('totale_imponibile').value = imponibile;
		document.getElementById('totale_IVA').value = IVA;
		document.getElementById('costo1').value = prestazione;
}

function calcolaPreventivo()
{
	somma = new Number();
	
	for(i=1;i<11;i++)
	{
		if(document.getElementById('costo'+i).value != null)
		{
			somma += Number(document.getElementById('quantita'+i).value)*Number(document.getElementById('costo'+i).value);
		}
	}
	
	somma = round(somma,2);
	somma = somma.toFixed(2);
	
	document.getElementById('totale_preventivo').value = somma;
}

function setPrestazione(i)
{
	if(document.getElementById('descrizione'+i).value != null && document.getElementById('descrizione'+i).value != "")
	{
		document.getElementById('quantita'+i).value = 1;
		document.getElementById('costo'+i).value = '0.00';
		document.getElementById('enpav'+i).value = 2;
		document.getElementById('IVA'+i).value = 22;
		document.getElementById('tipo_operazione'+i).value = 'imponibile'
		document.getElementById('quantita'+i).disabled = '';
		document.getElementById('costo'+i).disabled = '';
		document.getElementById('enpav'+i).disabled = '';
		document.getElementById('IVA'+i).disabled = '';
		document.getElementById('tipo_operazione'+i).disabled = '';
		document.getElementById('tipo_esenzione'+i).disabled = '';
	}
	else
	{
		document.getElementById('quantita'+i).disabled = 'disabled';
		document.getElementById('costo'+i).disabled = 'disabled';
		document.getElementById('enpav'+i).disabled = 'disabled';
		document.getElementById('IVA'+i).disabled = 'disabled';
		document.getElementById('tipo_operazione'+i).disabled = 'disabled';
		document.getElementById('tipo_esenzione'+i).disabled = 'disabled';
	}
}

function setEsame(id)
{
	document.getElementById(id.replace('_options','')).value = document.getElementById(id).value;
}

function round(n,dec) {
	n = parseFloat(n);
	if(!isNaN(n)){
		if(!dec) var dec= 0;
		var factor= Math.pow(10,dec);
		return Math.floor(n*factor+((n*factor*10)%10>=5?1:0))/factor;
	}else{
		return n;
	}
}

//Pazienti
function getPaziente(nome,microchip,razza,id)
{
	document.getElementById('nome_paziente').value=nome;
	document.getElementById('microchip_paziente').value=microchip;
	document.getElementById('razza_paziente').value=razza;
	document.getElementById('id_paziente').value=id;
}

//Data
function datadiff(id)
{
	var dt = new Date();
	if(id == 1)
		var datavaccino = document.getElementById('datepicker').value;
	else  datavaccino = document.getElementById('data_vaccino'+id).value;
	var vaccino = datavaccino.split("/");
	if(vaccino[0].substr(0,1) == "0")
		var giorno = vaccino[0].replace("0","");
	else
		var giorno = vaccino[0];
	if(vaccino[1].substr(0,1) == "0")	
		var mese = vaccino[1].replace("0","");
	else
		var mese = vaccino[1]
	var anno = vaccino[2];
	
	dt.setDate(giorno);
	dt.setMonth(parseInt(mese)-1);
	dt.setFullYear(anno);
	
	dt.setDate(dt.getDate() + parseInt(document.getElementById('durata'+id).value));
	
	if(parseInt(dt.getDate()) > 9)
		var data = dt.getDate()+'/';
	else
		var data = '0'+dt.getDate()+'/';
	
	if(parseInt(dt.getMonth()) > 8)
		data += (dt.getMonth()+1)+'/';
	else
		data += '0'+(dt.getMonth()+1)+'/';
	data+=dt.getFullYear();
	
	document.getElementById('data_scadenza'+id).value = data;
	
	dt.setDate(dt.getDate()-3);
	if(parseInt(dt.getDate()) > 9)
		var dataavv = dt.getDate()+'/';
	else
		var dataavv = '0'+dt.getDate()+'/';
	
	if(parseInt(dt.getMonth()) > 8)
		dataavv += (dt.getMonth()+1)+'/';
	else
		dataavv += '0'+(dt.getMonth()+1)+'/';
	dataavv+=dt.getFullYear();
	
	document.getElementById('data_avviso'+id).value = dataavv;
	
	if(document.getElementById('data_vaccino'+(id+1)).value != null)
	{
		document.getElementById('data_vaccino'+(id+1)).value = data;
		this.datadiff(id+1);
	}
}

////////////////////////////////////////////
$(document).ready(function(){
	$('#regione').change(function(){
		var elem = $(this).val();
		
		$.ajax({
			type: 'GET',
			url:'ajax/select.php',
			dataType: 'json',
			data: {'regione':elem},
			success: function(res){
				$('#provincia option').each(function(){$(this).remove()});
				$('#provincia').append('<option selected="selected">Seleziona la provincia...</option>');
				$('#comune option').each(function(){$(this).remove()});
				$('#comune').append('<option selected="selected">Seleziona...</option>');
				$('#cap').attr('value','');
				$.each(res, function(i, e){
					$('#provincia').append('<option value="' + e.codice + '">' + e.nome + '</option>');
				});
			}
		});
	});
	
	$('#provincia').change(function(){
		var elem = $(this).val();
		
		$.ajax({
			type: 'GET',
			url:'ajax/select.php',
			dataType: 'json',
			data: {'provincia':elem},
			success: function(res){
				$('#comune option').each(function(){$(this).remove()});
				$('#comune').append('<option selected="selected">Seleziona il comune...</option>');
				$('#cap').attr('value','');
				$.each(res, function(i, e){
					$('#comune').append('<option value="' + e.codice + '">' + e.nome + '</option>');
				});
			}
		});
	});
	
	$('#comune').change(function(){
		var elem = $(this).val();
		
		$.ajax({
			type: 'GET',
			url:'ajax/select.php',
			dataType: 'json',
			data: {'cod_istat':elem},
			success: function(res){
				$('#cap').attr('value',res);
			}
		});
	});
	
	$('#specie').change(function(){
		var elem = $(this).val();
		
		$.ajax({
			type: 'GET',
			url:'ajax/selectrazza.php',
			dataType: 'json',
			data: {'specie':elem},
			success: function(res){
				$('#razza option').each(function(){$(this).remove()});
				$('#razza').append('<option selected="selected">Seleziona una razza...</option>');
				$.each(res, function(i, e){
					$('#razza').append('<option value="' + e.codice + '">' + e.nome + '</option>');
				});
			}
		});
	});
});
