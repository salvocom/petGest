<?

class PDFEsamiEmocromo extends PDF
{
	
	function __construct() 
	{
		parent::__construct();		
	}
	
	function EsameEmocromo($cliente,$paziente,$esame)
	{
		$this->Ln(6);
		
		$this->SetFont('Arial','B',8);
		$this->Cell(190,0,"Emocromo",0,0,'C');
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
		$this->Cell(26,0,"RBC (mln): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['RBC']))
			$this->Cell(120,0,"$esame[RBC]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Hb (g/dl): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['Hb']))
			$this->Cell(120,0,"$esame[Hb]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"Hct (%): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['Hct']))
			$this->Cell(120,0,"$esame[Hct]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"MCV (fl): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['MCV']))
			$this->Cell(120,0,"$esame[MCV]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"MCH (pg): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['MCH']))
			$this->Cell(120,0,"$esame[MCH]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"MCHC (g/dl): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['MCHC']))
			$this->Cell(120,0,"$esame[MCHC]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"RDW (%): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['RDW']))
			$this->Cell(120,0,"$esame[RDW]",0,0,'L');
		$this->Ln(6);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"WBC (x 1000): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['WBC']))
			$this->Cell(120,0,"$esame[WBC]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"LYM (%): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['LYM_per']))
			$this->Cell(120,0,"$esame[LYM_per]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"MON (%): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['MON_per']))
			$this->Cell(120,0,"$esame[MON_per]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"GRA (%): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['GRA_per']))
			$this->Cell(120,0,"$esame[GRA_per]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"LYM (mln): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['LYM']))
			$this->Cell(120,0,"$esame[LYM]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"MON (mln): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['MON']))
			$this->Cell(120,0,"$esame[MON]",0,0,'L');
		$this->Ln(3);
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"GRA (mln): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['GRA']))
			$this->Cell(120,0,"$esame[GRA]",0,0,'L');
		$this->Ln(6);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"PLT (x 1000): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['PLT']))
			$this->Cell(120,0,"$esame[PLT]",0,0,'L');
		$this->Ln(3);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,0,"MPV (fl): ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['MPV']))
			$this->Cell(120,0,"$esame[MPV]",0,0,'L');
		$this->Ln(3);
		
		$this->Cell(20);
		$this->SetFont('Arial','B',6);
		$this->Cell(26,2,"Note: ",0,0,'L');
		$this->SetFont('Arial','',6);
		if(!is_null($esame['note']))
			$this->MultiCell(120,2,utf8_decode($esame['note']),0);
		$this->Ln(25);
		
		$this->SetFont('Arial','IB',6);
		$this->Cell(10);
		$data = explode('-',$esame['data']);
		$this->Cell(14,5,"Melilli, $data[2]/$data[1]/$data[0]",0,0,'L');
	}
	
}
