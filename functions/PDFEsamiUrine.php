<?

class PDFEsamiUrine extends PDF
{
	
	function __construct() 
	{
		parent::__construct();		
	}
	
	function EsameUrine($cliente,$paziente,$esame)
	{
		$this->Ln(6);
		
		$this->SetFont('Arial','B',8);
		$this->Cell(190,0,"Esame delle Urine",0,0,'C');
		$this->Ln(6);
		
		$this->setLineWidth(0.5);
		$this->Line(20, 65, 190, 65);
		
		$this->SetFont('Arial','B',6);
		$this->Cell(10);
		$this->Cell(14,5,"Proprietario: ",0,0,'L');
		$this->SetFont('Arial','',6);
		$this->Cell(0,5,"$cliente[nome] $cliente[cognome] ",0,0,'L');
		$this->Ln(10);
		
		$this->SetFont('Arial','B',6);
		$this->Cell(10);
		$this->Cell(14,5,"Paziente: ",0,0,'L');
		$this->SetFont('Arial','',6);
		$this->Cell(60,5,"$paziente[nome]",0,0,'L');
		
		$this->SetFont('Arial','B',6);
		$this->Cell(10,5,"Specie: ",0,0,'L');
		$this->SetFont('Arial','',6);
		$this->Cell(40,5,"$paziente[specie]",0,0,'L');
		$this->Ln(3);
		
		$this->SetFont('Arial','B',6);
		$this->Cell(10);
		$this->Cell(14,5,"Nato il: ",0,0,'L');
		$this->SetFont('Arial','',6);
		$data = explode('-',$paziente['data_di_nascita']);
		$this->Cell(60,5,"$data[2]/$data[1]/$data[0]",0,0,'L');
		
		$this->SetFont('Arial','B',6);
		$this->Cell(10,5,"Sesso: ",0,0,'L');
		$this->SetFont('Arial','',6);
		$this->Cell(40,5,"$paziente[sesso]",0,0,'L');
		$this->Ln(14);
		
		$this->SetFont('Arial','B',6);
		$this->setLineWidth(0.2);
		$this->Line(30, 94, 180, 94);
		$this->Ln();
		
		$this->Cell(20);
		$this->Cell(26,0,"Tecnica di Raccolta: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['tecnica_raccolta']))
			$this->Cell(120,0,"$esame[tecnica_raccolta]",0,0,'L');
		$this->Ln(6);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Cellule Epiteliali: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['cellule_epiteliali']))
			$this->Cell(120,0,"$esame[cellule_epiteliali]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Tipi di Cellule Epiteliali: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['tipi_cellule_epiteliali']))
			$this->Cell(120,0,"$esame[tipi_cellule_epiteliali]",0,0,'L');
		$this->Ln(6);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Batteri: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['batteri']))
			$this->Cell(120,0,"$esame[batteri]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Forms Batterica: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['forma_batterica']))
			$this->Cell(120,0,"$esame[forma_batterica]",0,0,'L');
		$this->Ln(6);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Cristalli: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['cristalli']))
			$this->Cell(120,0,"$esame[cristalli]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Tipi di Cristalli: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['tipo_cristalli']))
			$this->Cell(120,0,"$esame[tipo_cristalli]",0,0,'L');
		$this->Ln(6);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Peso Specifico: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['peso_specifico']))
			$this->Cell(120,0,"$esame[peso_specifico]",0,0,'L');
		$this->Ln(3);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"PH: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['ph']))
			$this->Cell(120,0,"$esame[ph]",0,0,'L');
		$this->Ln(3);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Leucociti (mg/dl): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['leucociti']))
			$this->Cell(120,0,"$esame[leucociti]",0,0,'L');
		$this->Ln(3);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Nitriti (mg/dl): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['nitriti']))
			$this->Cell(120,0,"$esame[nitriti]",0,0,'L');
		$this->Ln(3);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Urobilina (mg/dl): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['urobilina']))
			$this->Cell(120,0,"$esame[urobilina]",0,0,'L');
		$this->Ln(3);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Proteine (mg/dl): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['proteine']))
			$this->Cell(120,0,"$esame[proteine]",0,0,'L');
		$this->Ln(3);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Sangue: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['sangue']))
			$this->Cell(120,0,"$esame[sangue]",0,0,'L');
		$this->Ln(3);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Chetoni (mg/dl): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['chetoni']))
			$this->Cell(120,0,"$esame[chetoni]",0,0,'L');
		$this->Ln(3);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Bilirubina (mg/dl): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['bilirubina']))
			$this->Cell(120,0,"$esame[bilirubina]",0,0,'L');
		$this->Ln(3);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Glucosio (mg/dl): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['glucosio']))
			$this->Cell(120,0,"$esame[glucosio]",0,0,'L');
		$this->Ln(6);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,2,"Problemi: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['problemi']))
			$this->MultiCell(120,2,utf8_decode($esame['problemi']),0);
		$this->Ln(25);
		
		$this->SetFont('Arial','IB',6);
		$this->Cell(10);
		$data = explode('-',$esame['data']);
		$this->Cell(14,5,"Melilli, $data[2]/$data[1]/$data[0]",0,0,'L');
	}
	
}
