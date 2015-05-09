<?

require('fpdf/fpdf.php');
define('EURO', chr(128));

class PDF extends FPDF
{
	// Page header
	function pageHeader($ambulatorio)
	{
		$this->SetFont('Arial','B',12);

		$this->Image('images/logo.png',11,6,30);
		$this->Cell(0,23);
		$this->Ln();
	
		$this->SetFont('Arial','I',8);
		$this->Cell(190,0,"della D.ssa $ambulatorio[nome] $ambulatorio[cognome]",0,0,'L');
		$this->Ln(6);
		
		$this->SetFont('Arial','',6);
		$this->Cell(190,0,"$ambulatorio[indirizzo] - $ambulatorio[cap] $ambulatorio[citta]($ambulatorio[provincia])",0,0,'L');
		$this->Ln(3);
		if($ambulatorio['telefono'] != null)
		{
			$this->SetFont('Arial','',6);
			$this->Cell(190,0,"Telefono: $ambulatorio[telefono] - Cellulare: $ambulatorio[cellulare] - E-mail: $ambulatorio[mail]",0,0,'L');
			$this->Ln(3);
		}
		else
		{
			$this->SetFont('Arial','',6);
			$this->Cell(190,0,"Telefono: $ambulatorio[cellulare] - E-mail: $ambulatorio[mail]",0,0,'L');
			$this->Ln(3);
		}
		if($ambulatorio['codice_fiscale'] != null)
		{
			$this->SetFont('Arial','I',6);
			$this->Cell(190,0,"C.F:: $ambulatorio[codice_fiscale]",0,0,'L');
			$this->Ln(3);
		}
		if($ambulatorio['partita_iva'] != null)
		{
			$this->SetFont('Arial','I',6);
			$this->Cell(190,0,"P. Iva: $ambulatorio[partita_iva]",0,0,'L');
			$this->Ln(3);
		}
		
		$this->Ln(8);
	}

	function Cliente($cliente)
	{   
		$this->SetFont('Arial','I',7);
		$this->Cell(150);
		$this->Cell(0,0,'Spett.le',0,0,'L');
		$this->Ln(3);
		$this->SetFont('Arial','B',7);
		$this->Cell(150);
		$this->Cell(0,0,"$cliente[cognome] $cliente[nome]",0,0,'L');
		$this->Ln(3);
		$this->SetFont('Arial','',7);
		$this->Cell(150);
		$this->Cell(0,0,"$cliente[indirizzo]",0,0,'L');
		$this->Ln(3);
		$this->SetFont('Arial','',7);
		$this->Cell(150);
		$this->Cell(0,0,"$cliente[cap] $cliente[comune]($cliente[provincia])",0,0,'L');
		$this->Ln(3);
		if($cliente['codice_fiscale'] != null)
		{
			$this->Cell(150);
			$this->SetFont('Arial','I',7);
			$this->Cell(0,0,"C.F:: $cliente[codice_fiscale]",0,0,'L');
			
		}
		if($cliente['partita_iva'] != null)
		{
			$this->Ln(3);
			$this->Cell(150);
			$this->SetFont('Arial','I',7);
			$this->Cell(0,0,"P. Iva: $cliente[partita_iva]",0,0,'L');
		}
		$this->Ln(20);
	}
	
	function Fattura($fattura)
	{   
		$this->SetFont('Arial','B',7);
		$this->Cell(20);
		$this->Cell(0,0,"Fattura n. $fattura[numero_fattura]",0,0,'L');
		$this->Ln(3);
		$this->SetFont('Arial','',7);
		$this->Cell(20);
		$data = explode('-',$fattura['data']);
		$this->Cell(0,0,"Data: $data[2]/$data[1]/$data[0]",0,0,'L');
		$this->Ln(3);
		
	}
	
	function PrestazioniFattura($header,$prestazioni,$fattura)
	{   
		// Colors, line width and bold font
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.2);
		$this->SetFont('','B');
		// Header
		$this->Cell(20);
		$w = array(70, 12, 12, 12, 16, 35);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],6,$header[$i],1,0,'L',true);
		$this->Ln();
		// Data
		$fill = false;
		foreach($prestazioni as $row)
		{
			// Color and font restoration
			$this->SetFont('Arial','',7);
			$this->Cell(20);
			$row['descrizione'] = strtolower($row['descrizione']);
			$row['descrizione'] = strtoupper(substr($row['descrizione'],0,1)).substr($row['descrizione'],1);
			$this->Cell($w[0],5,$row['descrizione'],'LR',0,'L',$fill);
			$this->Cell($w[1],5,$row['quantita'],'LR',0,'R',$fill);
			if($row['enpav'] == null)
				$this->Cell($w[2],5,'-','LR',0,'R',$fill);
			else
				$this->Cell($w[2],5,$row['enpav'].'%','LR',0,'R',$fill);
			if($row['IVA'] == null)
				$this->Cell($w[3],5,'-','LR',0,'R',$fill);
			else
				$this->Cell($w[3],5,$row['IVA'].'%','LR',0,'R',$fill);
			$this->Cell($w[4],5,str_replace('.',',',EURO.'   '.$row['costo']),'LR',0,'R',$fill);
			$this->SetFont('Arial','I',5);
			$this->Cell($w[5],5,$row['tipo_esenzione'],0,0,'L',$fill);
			$this->Ln();
		}
		
		$blanks = new SplFixedArray(12-count($prestazioni));
		
		foreach($blanks as $blank)
		{
			$this->Cell(20);
			$this->Cell($w[0],5,'','LR',0);
			$this->Cell($w[1],5,'','LR',0);
			$this->Cell($w[2],5,'','LR',0);
			$this->Cell($w[3],5,'','LR',0);
			$this->Cell($w[4],5,'','LR',0);
			$this->Ln();
		}
		
		$this->SetFont('Arial','',7);
		$this->Cell(20);
		$this->Cell($w[0],35,'',1,0,'L',$fill);
		$this->Cell(28,5,"Totale Prestazioni",'TLB',0,'R',$fill);
		$this->Cell(8,5,'','TRB');
		$this->Cell(16,5,str_replace('.',',',EURO.'   '.$fattura['totale_prestazione']),1,0,'R',$fill);
		$this->Ln();
		$this->Cell(90);
		$this->Cell(28,5,"Totale Enpav",'TLB',0,'R',$fill);
		$this->Cell(8,5,'','TRB');
		$this->Cell(16,5,str_replace('.',',',EURO.'   '.$fattura['totale_enpav']),1,0,'R',$fill);
		$this->Ln();
		$this->Cell(90);
		$this->Cell(28,5,"Totale Iimponibile",'TLB',0,'R',$fill);
		$this->Cell(8,5,'','TRB');
		$this->Cell(16,5,str_replace('.',',',EURO.'   '.$fattura['totale_imponibile']),1,0,'R',$fill);
		$this->Ln();
		$this->Cell(90);
		$this->Cell(28,5,"Totale IVA",'TLB',0,'R',$fill);
		$this->Cell(8,5,'','TRB');
		$this->Cell(16,5,str_replace('.',',',EURO.'   '.$fattura['totale_IVA']),1,0,'R',$fill);
		$this->Ln();
		$this->Cell(90);
		$this->Cell(28,5,"Totale Fattura",'TLB',0,'R',$fill);
		$this->Cell(8,5,'','TRB');
		$this->Cell(16,5,str_replace('.',',',EURO.'   '.$fattura['totale_imponibile-IVA']),1,0,'R',$fill);
		$this->Ln();
		$this->Cell(90);
		$this->Cell(28,5,"Ritenuta d'Acconto 4%",'TLB',0,'R',$fill);
		$this->Cell(8,5,'','TRB');
		$this->Cell(16,5,str_replace('.',',',EURO.'   '.$fattura['ritenuta_di_acconto']),1,0,'R',$fill);
		$this->Ln();
		$this->SetFont('Arial','B',7);
		$this->Cell(90);
		$this->Cell(28,5,"Netto Da Pagare",'TLB',0,'R',$fill);
		$this->Cell(8,5,'','TRB');
		$this->Cell(16,5,str_replace('.',',',EURO.'   '.$fattura['totale_fattura']),1,0,'R',$fill);
	}
	
	function Preventivo($preventivo)
	{   
		$this->SetFont('Arial','B',7);
		$this->Cell(20);
		$this->Cell(0,0,"Preventivo n. $preventivo[ID]",0,0,'L');
		$this->Ln(3);
		$this->SetFont('Arial','',7);
		$this->Cell(20);
		$data = explode('-',$preventivo['data']);
		$this->Cell(0,0,"Data: $data[2]/$data[1]/$data[0]",0,0,'L');
		$this->Ln(3);
		
	}
	
	function PrestazioniPreventivo($header,$prestazioni,$preventivo)
	{   
		$this->Cell(20);
		$this->Cell(180,5,'Prendo atto che i costi da sostenere per gli interventi di seguito specificati sono da considerarsi indicativi in quanto basati su di una visita',0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->Cell(180,5,'clinica e quindi suscettibili di variazioni dovute a necessita\' di carattere tecnico.',0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->Cell(180,5,'Dichiaro di essere stato informato della necessita\' di saldare tutte le competenze per le cure fornite al mio animale al completamento',0,0,'L'); 
		$this->Ln(3);
		$this->Cell(20);
		$this->Cell(180,5,'delle stesse ed in ogni caso prima della dimissione.',0,0,'L');
		$this->Ln();
		$this->Ln();
		$this->Ln();
		
		// Colors, line width and bold font
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.2);
		$this->SetFont('','B');
		// Header
		$this->Cell(20);
		$w = array(70, 12, 16);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],6,$header[$i],1,0,'L',true);
		$this->Ln();
		// Data
		$fill = false;
		foreach($prestazioni as $row)
		{
			// Color and font restoration
			$this->SetFont('Arial','',7);
			$this->Cell(20);
			$row['descrizione'] = strtolower($row['descrizione']);
			$row['descrizione'] = strtoupper(substr($row['descrizione'],0,1)).substr($row['descrizione'],1);
			$this->Cell($w[0],5,$row['descrizione'],'LR',0,'L',$fill);
			$this->Cell($w[1],5,$row['quantita'],'LR',0,'R',$fill);
			$this->Cell($w[2],5,str_replace('.',',',EURO.'   '.$row['costo']),'LR',0,'R',$fill);
			$this->Ln();
		}
		
		$blanks = new SplFixedArray(12-count($prestazioni));
		
		foreach($blanks as $blank)
		{
			$this->Cell(20);
			$this->Cell($w[0],5,'','LR',0);
			$this->Cell($w[1],5,'','LR',0);
			$this->Cell($w[2],5,'','LR',0);
			$this->Ln();
		}
		
		$this->SetFont('Arial','B',7);
		$this->Cell(20);
		$this->Cell($w[0],10,'',1,0,'L',$fill);
		$this->Cell(28,5,"Totale Preventivo",'TLR',0,'C',$fill);
		$this->Ln();
		$this->Cell(90);
		$this->Cell(28,5,str_replace('.',',',EURO.'   '.$preventivo['totale_preventivo']),'BLR',0,'C',$fill);
		$this->Ln(30);
		$this->SetFont('Arial','',7);
		$this->Cell(120);
		$this->Cell(0,0,'Firma   ___________________________',0,0,'L');
	}

	// Page footer
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

?>
